<?php

require __DIR__ . '/application/libraries/phpmailer/src/Exception.php';
//require '/home/usernamecPanel/public_html/application/libraries/phpmailer/src/Exception.php';
require __DIR__ . '/application/libraries/phpmailer/src/PHPMailer.php';
//require '/home/usernamecPanel/public_html/application/libraries/phpmailer/src/PHPMailer.php';
require __DIR__ . '/application/libraries/phpmailer/src/SMTP.php';
//require '/home/usernamecPanel/public_html/application/libraries/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//get mailer config
$config = dbget('mailer_config')[0];

$config['email_status'] = [
	'unread'	=> 7,
	'read'		=> 8,
	'queued'	=> 9,
	'sent'		=> 10,
	'error'		=> 11,
	'process'	=> 33
];

$config['log'] = [
	'dir' => __DIR__ . '/application/logs/',
	'error' => 'error_log_'.date('Ymd').'.log',
	'success' => 'success_log_'.date('Ymd').'.log'
];

// get email on queue
$condition = [
	'DATE(create_date) = \''.date('Y-m-d').'\'',
	'email_status_id = '.$config['email_status']['queued'],
	'direction_id = 2'
];

$emails = dbget('emails', [], $condition);

if ($emails) {
	foreach ($emails as $email) {
		$mail = new PHPMailer(true);

		try {
			// Server settings
			$mail->SMTPOptions = [
				'ssl' => [
					'verify_peer'       => false,
					'verify_peer_name'  => false,
					'allow_self_signed' => true
				]
			];

			// SMTP configuration
			$mail->isSMTP();
			$mail->isHTML(true);
			$mail->Host       = $config['host'];
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = $config['encryption'];
			$mail->Port       = $config['port'];
			$mail->SMTPDebug  = 3;
			$mail->Username   = $config['username'];
			$mail->Password   = $config['password'];

			//$mail->Sender     = $config['username'];
			//$mail->From       = (!empty($email['email_from']) ? $email['email_from'] : $config['username']);
			//$mail->FromName   = (!empty($email['email_from']) ? $email['email_from'] : $config['username']);

			// Set from
			$mail->setFrom($config['username']);
			// Email subject & body
			$mail->Subject    = $email['subject'];
			$mail->Body       = $email['content_html'];

			$mail->clearAllRecipients();

			// Add recipient
			if ($email['email_to']) {
				$recipient_num = substr_count($email['email_to'], ';');
				$recipient = explode(';', $email['email_to']);

				for ($i=0; $i<=$recipient_num; $i++) {
					if (!empty($recipient[$i])) {
						$email_to = str_replace(' ', '', $recipient[$i]);

						if (filter_var($email_to, FILTER_VALIDATE_EMAIL)) {
							$mail->addAddress($recipient[$i]);
						}
					}
				}
			}

			// Add CC
			if ($email['email_cc']) {
				$cc_num = substr_count($email['email_cc'], ';');
				$cc = explode(';', $email['email_cc']);
				
				for ($i=0; $i<=$cc_num; $i++) {
					$email_cc = str_replace(' ', '', $cc[$i]);

					if (filter_var($email_cc, FILTER_VALIDATE_EMAIL)) {
						$mail->addCC($cc[$i]);
					}
				}
			}

			// add BCC
			if ($email['email_bcc']) {
				$bcc_num = substr_count($email['email_bcc'], ';');
				$bcc = explode(';', $email['email_bcc']);
				
				for ($i=0; $i<=$bcc_num; $i++) {
					$email_bcc = str_replace(' ', '', $bcc[$i]);

					if (filter_var($email_bcc, FILTER_VALIDATE_EMAIL)) {
						$mail->addBCC($bcc[$i]);
					}
				}
			}

			echo "\nMail debug :".$mail->SMTPDebug;
			echo "\nMail Host :".$mail->Host;
			echo "\nMail SMTP Auth :".$mail->SMTPAuth;
			echo "\nMail SMTPSecure :".$mail->SMTPSecure;
			echo "\nMail SMTPPort :".$mail->Port;
			echo "\nMail Username :".$mail->Username;
			echo "\nMail Password :".$mail->Password;
			echo "\nMail Sender :".$mail->Sender;
			echo "\nMail From :".$mail->From;
			echo "\nMail FromName :".$mail->FromName;
			echo "\nMail Subject :".$mail->Subject;
			echo "\nMail Body :".$mail->Body;
			echo PHP_EOL;

			// update email status to process
			$condition = [
				'id' => $email['id']
			];

			$data = [
				'email_status_id' => $config['email_status']['process']
			];

			$process = dbupdate('emails', $condition, $data);

			if ($process) {
				$mail->send();

				// update email status to sent
				$condition = [
					'id' => $email['id']
				];

				$data = [
					'email_status_id' => $config['email_status']['sent'],
					'email_from'      => $config['username'],
					'email_date'      => date('Y-m-d H:i:s')
				];

				$sent = dbupdate('emails', $condition, $data);
				
				if (!$sent) {
					createLog($config['log']['dir'].$config['log']['error'], 'Email successfully sent || Error to update status to SENT. Email ID: '.$email['id']);
				}
			} else {
				createLog($config['log']['dir'].$config['log']['error'], 'Failed to update status to PROCESS || Email not send. Email ID: '.$email['id']);
			}

			$mail->clearAddresses();
			$mail->clearAttachments();
		} catch (Exception $e) {
			// update email status to error
			$condition = [
				'id' => $email['id']
			];

			$data = [
				'email_status_id' => $config['email_status']['error'],
				'mail_error_info' => $mail->ErrorInfo
				//'mail_error_info' => $e->errorMessage()
			];

			$error = dbupdate('emails', $condition, $data);

			if (!$error) {
				createLog($config['log']['dir'].$config['log']['error'], '[SENDER] '.$mail->ErrorInfo.' || Error to update status to: '.$config['email_status']['error'].'. Email ID: '.$email['id']);
			} else {
				createLog($config['log']['dir'].$config['log']['error'], '[SENDER] '.$mail->ErrorInfo);
			}

			echo 'Message could not be sent.';
			echo PHP_EOL;
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			echo PHP_EOL;
		}
	}
}

/**
 *  createLog method
 *  create log for every request (input request info to .log file)
 *  @param string $targetFile
 */
function createLog($targetFile, $log) 
{
	$data = sprintf(
		"%s \n%s",
		date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
		$log
	);
	
	file_put_contents(
		$targetFile,
		$data . file_get_contents('php://input') . "\n========================================\n",
		FILE_APPEND // always update (not replace)
	);
}

/**
 *  dbconnect method
 *  database connection using pdo
 */
function dbconnect()
{		
	$db = [
		'host'		=> 'localhost',
		'dbname'	=> 'ci_company',
		'username'	=> 'root',
		'password'	=> ''
	];
	
	$con = new PDO("mysql:host=".$db['host'].";dbname=".$db['dbname'].";charset=utf8", $db['username'], $db['password']);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $con;
}

/**
 *  dbcheck method
 *  check data from table
 *  @param string $table, array $condition
 *  @return bool $count
 */
function dbcheck($table, $condition = [])
{	
	$cond = '';
	
	if (!empty($condition)) {
		$i = 1;
		
		foreach ($condition as $key => $value) {
			if ($i == 1) {
				$cond .= $key." = ".dbconnect()->quote($value); 
			} else {
				$cond .= " AND ".$key." = ".dbconnect()->quote($value);
			}
			
			$i++;
		}
	}
	
	$check = dbconnect()->prepare("SELECT COUNT(*) FROM ".$table." WHERE ".$cond);
	$check->execute();
	$count = $check->fetchColumn();
	
	return $count;
}

/**
 *  dbget method
 *  get all data from table
 *  @param string $table, array $clause, array $condition
 *  @return array $result
 */
function dbget($table, $clause = [], $condition = [])
{
	$cond = '';
	$query = "SELECT * FROM ".$table;
	
	if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
		$query = "SELECT * FROM ".$table." ORDER BY ".$clause['sort']." ".$clause['order'];
	}	
	
	if (!empty($condition)) {
		$i = 1;
		
		foreach ($condition as $c) {
			if ($i == 1) {
				$cond .= $c; 
			} else {
				$cond .= " AND ".$c;
			}
			
			$i++;
		}
		
		$query = "SELECT * FROM ".$table." WHERE ".$cond;
		
		if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
			$query = "SELECT * FROM ".$table." WHERE ".$cond." ORDER BY ".$clause['sort']." ".$clause['order'];
		}
	}
	
	if (array_key_exists('limit', $clause)) {
		if (is_numeric($clause['limit'])) {
			$query .= " LIMIT ".$clause['limit'];
		}
	}
	
	$data = dbconnect()->prepare($query);
	$data->execute();
	
	$data_temp = [];
	
	while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		$data_temp[] = $row;
	}
	
	$result = $data_temp;
	
	/* if (count($data_temp) == 1) {
		$single_data = [];
		
		foreach($data_temp as $value) {
			$single_data += $value;
		}
		
		$result = $single_data;
	} */
	
	return $result;
}

/**
 *  dbinsert method
 *  insert data to table
 *  @param string $table, array $data
 *  @return bool $inserted
 */
function dbinsert($table, $data)
{
	$data_temp = '';
	$inserted = 0;
	
	if (!empty($data)) {
		$i = 1;
		
		foreach ($data as $key => $value) {
			if ($i == 1) {
				$data_temp .= $key." = ".dbconnect()->quote($value);
			} else {
				$data_temp .= ", ".$key." = ".dbconnect()->quote($value);
			}
			
			$i++;
		}
	}

	if (!empty($data_temp)) {
		$query = dbconnect()->prepare("INSERT INTO ".$table." SET ".$data_temp);
		$query->execute();
		$inserted = $query->rowCount();
	}
	
	return $inserted;
}

/**
 *  dbinsertMany method
 *  insert data to table
 *  @param string $table, array $data
 *  @return bool $inserted
 */
function dbinsertMany($table, $column, $data)
{
	$column_temp = '';
	$data_temp = '';
	$inserted = 0;
	
	if (!empty($column)) {
		$i = 1;
		$column_temp .= '(';
		
		foreach ($column as $key => $value) {			
			if ($i == 1) {
				$column_temp .= $value;
			} else {
				$column_temp .= ', '.$value;
			}
			
			$i++;
		}
		
		$column_temp .= ')';
	}
	
	if (!empty($data)) {
		$i = 1;
		$total = count($data);
		
		foreach ($data as $key => $value) {				
			$data_temp .= '(';
			
			foreach ($value as $key => $index) {
				if ($key == max(array_keys($value))) {
					$data_temp .= "'".$index."'";
				} else {
					$data_temp .= "'".$index."', ";
				}
			}
			
			$data_temp .= ')';

			if ($total > $i) {
				$data_temp .= ', ';
			}
			
			$i++;
		}
	}
	
	if (!empty($column_temp) && !empty($data_temp)) {
		$query = dbconnect()->prepare("INSERT INTO ".$table." ".$column_temp." VALUES ".$data_temp);
		$query->execute();
		$inserted = $query->rowCount();
	}
	
	return $inserted;
}

/**
 *  dbupdate method
 *  update data to table
 *  @param string $table, array $condition, array $data
 *  @return bool $updated
 */
function dbupdate($table, $condition, $data)
{
	$cond = '';
	$data_temp = '';
	$updated = 0;
	
	if (!empty($condition)) {
		$i = 1;
		
		foreach ($condition as $key => $value) {
			if ($i == 1) {
				$cond .= $key." = ".dbconnect()->quote($value); 
			} else {
				$cond .= " AND ".$key." = ".dbconnect()->quote($value);
			}
			
			$i++;
		}
	}
	
	if (!empty($data)) {
		$i = 1;
		
		foreach ($data as $key => $value) {
			if ($i == 1) {
				if ($value == '') {
					$data_temp .= $key." = 'NULL'";
				} else {
					$data_temp .= $key." = ".dbconnect()->quote($value); 
				}
			} else {
				if ($value == '') {
					$data_temp .= ", ".$key." = 'NULL'";
				} else {
					$data_temp .= ", ".$key." = ".dbconnect()->quote($value);
				}
			}
			
			$i++;
		}
	}

	if (!empty($data_temp) && !empty($cond)) {
		$query = dbconnect()->prepare("UPDATE ".$table." SET ".$data_temp." WHERE ".$cond);
		
		if ($query->execute()) {
			$updated = 1;
		}
		
		//$updated = $query->execute();
	}

	return $updated;
}

/**
 *  dbdelete method
 *  delete data from table
 *  @param string $table, array $condition
 *  @return bool $deleted
 */
function dbdelete($table, $condition)
{
	$cond = '';
	
	if (!empty($condition)) {
		$i = 1;
		
		foreach ($condition as $key => $value) {
			if ($i == 1) {
				$cond .= $key." = ".dbconnect()->quote($value); 
			} else {
				$cond .= " AND ".$key." = ".dbconnect()->quote($value);
			}
			
			$i++;
		}
	}

	$query = dbconnect()->prepare("DELETE FROM ".$table." WHERE ".$cond);
	$query->execute();
	
	$deleted = $query->rowCount();

	return $deleted;
}