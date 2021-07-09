<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!function_exists('PdfWorkerProfile')) {
	function PdfWorkerProfile($worker = [], $company = [], $paper_size = 'A4', $orientation = 'portrait') {
		$result = false;

		if (is_array($worker) && !empty($worker) && is_array($company) && !empty($company)) {
            $company_logo = (@getimagesize(FCPATH . 'files/company/thumb/' . $company['logo'])) ? '<img src="' . FCPATH . 'files/company/thumb/' . $company['logo'] . '" alt="Company Logo">' : $company['name'];

            $worker_photo = (@getimagesize(FCPATH . 'files/workers/' . $worker['id'] . '/' . $worker['photo'])) ? '<img src="' . FCPATH . 'files/workers/' . $worker['id'] . '/' . $worker['photo'] . '" alt="Worker Photo">' : '<img src="' . FCPATH . 'assets/img/default-avatar.jpg' . '" alt="Worker Photo">';

			ob_start();
			echo '<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
					<title>Document</title>
					<style>
						@font-face {
							font-family: chinese;
							src: url(\'' . base_url('assets/font/pdf/wts11.ttf') . '\') format(\'truetype\');
						}

						.chinese-font {
							font-family: chinese !important;
						}

						td {
							width: 20%;
							font-size: 12px;
						}
				
						table.kop.atas {
							text-align: center;
						}

						.no-ref {
							// font-weight: bold;
							color: black;
						}
				
						.kop-background {
							border: 1px solid black;
							background-color: red;
							color: white;
							text-align: center;
							font-size: 12px;
							text-transform: uppercase;
							font-weight: bold;
						}
				
						.kop-nama {
							text-transform: uppercase;
							width: 100%;
							line-height: 1.6;
							border: 1px solid black;
							text-indent: 30px;
						}
				
						img {
							width: 100%;
							height: 500px;
							border: 1px solid black;
						}

						.row-img {
							width: 50%;
							float: right;
						}
				
						.ability {
							width: 50%;
							border: 1px solid black;
							text-indent: 10px;
							line-height: 1.6;
						}
				
						.experience, .family {
							width: 50%;
							text-indent: 5px;
						}
				
						.employ-detail {
							border: 1px solid black;
							background-color: red;
							color: white;
							text-indent: 10px;
							text-align: left;
							line-height: 1,6;
							font-size: 12px;
							font-weight: bold;
						}
				
						.employ-body {
							text-indent: 10px;
							border: 1px solid black;
						}

						.q-satu {
							text-align: center;
							text-indent: 15px;
							font-size: 12px;
						}

						.q-dua {
							text-align: center;
							font-weight: bold;
							font-size: 12px;
						}
					</style>
				</head>

				<body>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop atas">
						<tr>
							<td>
								<h4>PT. AMALIA ROZIKIN JAYA - ARJ <br>
									INDONESIAN DOMESTIC HELPER SPECIALIST</h4>
							</td>
						</tr>
					</table>

					<h5 class="no-ref">REF No. <span class="chinese-font">工人編號</span> : '.$worker['ref_number'].'</h5>

					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop-background">
						<tbody>
							<tr>
								<th>
									<p>PERSONAL DATA <span class="chinese-font">個人資料</span></p>
								</th>
							</tr>
						</tbody>
					</table>

					<table cellspacing="0" cellpadding="0" class="kop-nama">
						<tr>
							<td><strong>Name <span class="chinese-font">姓名</span> &nbsp; : ' . $worker['fullname'] . '</strong></td>
						</tr>
					</table>

					<div class="row-img">
						' . $worker_photo .'
					</div>
					
					<table class="experience" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td>Date of birth <span class="chinese-font">出生日期</span> </td>
							<td>'. $worker['birth_date'] .'</td>
							<th colspan="2" class="kop-background">EXPERIENCE/ SKILLS <span class="chinese-font">工作經驗/能力</span></th>
						</tr>
						<tr>
							<td>Place of birth <span class="chinese-font">出生地點</span></td>
							<td>'. $worker['birth_place'] .'</td>
							<td>Household 家務</td>
							<td></td>
						</tr>
						<tr>
							<td>Religion <span class="chinese-font">宗教</span></td>
							<td>'. $worker['religion_id'] .'</td>
							<td>Cooking 煮菜</td>
							<td></td>
						</tr>
						<tr>
							<td>Age <span class="chinese-font">年領</span></td>
							<td></td>
							<td>Taking care elderly <span class="chinese-font">照顧老人</span></td>
							<td></td>
						</tr>
						<tr>
							<td>Marital Status <span class="chinese-font">婚姻狀況</span></td>
							<td></td>
							<td>Taking care children <span class="chinese-font">照顧嬰兒</span></td>
							<td></td>
						</tr>
						<tr>
							<td>Height <span class="chinese-font">身高</span></td>
							<td>'. $worker['height'] .'</td>
							<td>Taking care baby 照顧小孩</td>
							<td></td>
						</tr>
						<tr>
							<td>Weight <span class="chinese-font">體重</span></td>
							<td>'. $worker['weight'] .'</td>
							<td>Others <span class="chinese-font">其他</span></td>
							<td></td>
						</tr>
					</table>

					<table width="50%" class="kop-background">
						<tbody>
							<tr>
								<th>FAMILY BACKGROUND <span class="chinese-font">家庭背景</span></th>
							</tr>
						</tbody>
					</table>

					<table class="family" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td>Spouses name <span class="chinese-font">丈夫</span></td>
							<td>'. $worker['spouse_name'] .'</td>
							<td>Fathers name <span class="chinese-font">父親</span></td>
							<td>'. $worker['father_name'] .'</td>
						</tr>
						<tr>
							<td>Occupation <span class="chinese-font">工作</span></td>
							<td>'. $worker['spouse_occupation'] .'</td>
							<td>Fathers Occupation <span class="chinese-font">父親</span></td>
							<td>'. $worker['father_occupation'] .'</td>
						</tr>
						<tr>
							<td>Children <span class="chinese-font">小孩</span></td>
							<td></td>
							<td>Mothers Name <span class="chinese-font">母親</span></td>
							<td>'. $worker['mother_name'] .'</td>
						</tr>
						<tr>
							<td>Ages of Children <span class="chinese-font">年齡</span></td>
							<td></td>
							<td>Mothers Occupation <span class="chinese-font">母親</span></td>
							<td>'. $worker['mother_occupation'] .'</td>
						</tr>
						<tr>
							<td colspan="4">
								Other information <span class="chinese-font">其他訊息</span> :
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, ex.
							</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" class="ability">
						<tr>
							<th colspan="2" class="kop-background">Languange Ability <span class="chinese-font">語言能力</span></th>
						</tr>
						<tr>
							<td>English <span class="chinese-font">英文</span></td>
							<td>V</td>
						</tr>
						<tr>
							<td>Cantonese <span class="chinese-font">廣東話</span></td>
							<td>V</td>
						</tr>
						<tr>
							<td>Mandarin <span class="chinese-font">國語</span></td>
							<td>V</td>
						</tr>
						<tr>
							<td>Hokkian <span class="chinese-font">福建話</span></td>
							<td>V</td>
						</tr>
						<tr>
							<th colspan="2" style="font-size:12px; text-align: left;">Other <span class="chinese-font">其它</span> :</th>
						</tr>
						<tr>
							<th colspan="2" class="kop-background">Education <span class="chinese-font">教育程度</span></th>
						</tr>
						<tr>
							<td colspan="2">
								<p style="font-size: 12px; color: black; text-align:center;">Junior High School <span class="chinese-font">中學</span></p>
							</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" class="ability">
						<tr>
							<th colspan="2" class="kop-background">Cooking <span class="chinese-font">煮食</span></th>
						</tr>
						<tr>
							<td>Chinese</td>
							<td></td>
						</tr>
						<tr>
							<td>Western</td>
							<td>V</td>
						</tr>
						<tr>
							<td>Indonesia</td>
							<td></td>
						</tr>
						<tr style="height: 115px;">
							<td>Home Cooking</td>
							<td>V</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" class="ability">
						<tr>
							<th colspan="2" class="kop-background">Working Ex <span class="chinese-font">工作經驗</span></th>
						</tr>
						<tr>
							<td>Indonesia 印尼</td>
							<td></td>
						</tr>
						<tr>
							<td>Hongkong 香港</td>
							<td></td>
						</tr>
						<tr>
							<td>Taiwan 台灣</td>
							<td>4 years</td>
						</tr>
						<tr>
							<td>Singapore 新加坡</td>
							<td></td>
						</tr>
						<tr>
							<td>Malaysia 馬來西亞</td>
							<td></td>
						</tr>
						<tr>
							<td>Middle East 中東</td>
							<td></td>
						</tr>
						<tr style="height: 43px;">
							<td>Other 其他國家</td>
							<td></td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th class="employ-detail">PREVIOUS EMPLOYMENT DETAILS 前雇主資料</th>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%" class="employ-body">
						<tr>
							<td colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">
								Name Of Employer 雇主 :
							</td>
						</tr>
						<tr>
							<td>Working Area 工作地點 :</td>
							<td>Country 國家</td>
							<td><b>Taiwan</b></td>
						</tr>
						<tr>
							<td>Reason of Quit 終止合約/不續約原因:</td>
							<td>Periodic 期間</td>
							<td><b>2010-2017</b></td>
						</tr>
						<tr>
							<td colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">
								Job Content 工作內容: works include cooking,house keeping,take care of elderly ( 84 years old ) and all general housework.
							</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%" class="employ-body">
						<tr>
							<td colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">
								Name Of Employer 雇主 :
							</td>
						</tr>
						<tr>
							<td>Working Area 工作地點 :</td>
							<td>Country 國家</td>
							<td><b>Taiwan</b></td>
						</tr>
						<tr>
							<td>Reason of Quit 終止合約/不續約原因:</td>
							<td>Periodic 期間</td>
							<td><b>2017-2019</b></td>
						</tr>
						<tr>
							<td colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">
								Job Content 工作內容: works include cooking,house keeping,take care of elderly ( 70 years old ) and all general housework.
							</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th class="employ-detail">Personal Character Evaluation 女傭總體評價</th>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td colspan="3" height="30px" text-indent: 20px;>
								<p style="font-size:14px; text-indent: 20px;">
									She is studying hard Cantonese in the training center
								</p>
								<p style="font-size:8px; color: red; text-indent: 20px;">
									* Please note that we are not able to bear fully responsibility for this evaluation result due to human act.
								</p>
							</td>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th class="employ-detail">SUPLEMENTARY QUESTIONS 附加問題</th>
						</tr>
					</table>

					<table border="1" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th colspan="4"></th>
						</tr>
						<tr>
							<td class="q-satu">
								1) Will you work where there are pets?
							</td>
							<td colspan="3" class="q-dua" style="background-color:#ADD8E6;">
								YES
							</td>
							<td colspan="3" class="q-dua" style="background-color:#ADD8E6;">
								NO
							</td>
							<td colspan="3" style="text-indent: 10px; font-weight:bold; ">
								Remark :
							</td>
						</tr>
						<tr>
							<td class="q-satu">
								2) Do you have any allergies (such as skin allergy)?
							</td>
							<td colspan="3" class="q-dua">
								X
							</td>
							<td colspan="3" class="q-dua">
								
							</td>
							<td colspan="3">
								
							</td>
						</tr>
						<tr>
							<td class="q-satu">
								3) Do you have any knowledge in gardening?
							</td>
							<td colspan="3" class="q-dua">
								X
							</td>
							<td colspan="3" class="q-dua">
								
							</td>
							<td colspan="3">
								
							</td>
						</tr>
						<tr>
							<td class="q-satu">
								4) Can you handle and cook pork? 
							</td>
							<td colspan="3" class="q-dua">
								X
							</td>
							<td colspan="3" class="q-dua">
								
							</td>
							<td colspan="3">
								
							</td>
						</tr>
						<tr>
							<td class="q-satu">
								5) Can you do eat pork?
							</td>
							<td colspan="3" class="q-dua">
								X
							</td>
							<td colspan="3" class="q-dua">
								
							</td>
							<td colspan="3">
								
							</td>
						</tr>
					</table>
				</body>
			</html>';
			$content = ob_get_clean();

			$pdf = new Dompdf();
			$pdf->loadHtml($content);
			$pdf->setPaper($paper_size, $orientation);
			$pdf->render();

			// header('Content-Type: application/pdf; charset=utf-8');
			// header('Content-disposition: inline; filename="worker_' . base64url_encode($worker['id']) . '.pdf"', true);

			// echo $pdf->output(); exit;

			$output = $pdf->output();

			$filepath = 'files/workers/' . $worker['id'] . '/';

			if (!is_dir('./' . $filepath)) {
				mkdir('./' . $filepath, 0777, true);
			}

			$filename = 'worker_' . base64url_encode($worker['id']) . '.pdf';

			file_put_contents($filepath.$filename, $output);

			$result = [
				'filepath'	=> $filepath.$filename,
				'fileurl'	=> base_url($filepath.$filename)
			];
		}

		return $result;
	}
}
