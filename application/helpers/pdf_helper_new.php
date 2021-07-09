<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!function_exists('PdfWorkerProfile')) {
	function PdfWorkerProfile($worker = [], $company = [], $paper_size = 'A4', $orientation = 'portrait') {
		$result = false;

		// print_r($worker); die();

		if (is_array($worker) && !empty($worker) && is_array($company) && !empty($company)) {
            $company_logo = (@getimagesize(FCPATH . 'files/company/thumb/' . $company['logo'])) ? '<img src="' . FCPATH . 'files/company/thumb/' . $company['logo'] . '" alt="Company Logo">' : $company['name'];

            $worker_photo = (@getimagesize(FCPATH . 'files/workers/' . $worker['id'] . '/' . $worker['photo'])) ? '<img src="' . FCPATH . 'files/workers/' . $worker['id'] . '/' . $worker['photo'] . '" alt="Worker Photo">' : '<img src="' . FCPATH . 'assets/img/default-avatar.jpg' . '" alt="Worker Photo">';

			$content =
			'<style>				
				h2 {
					text-align: center;
					font-weight: bold;
				}

				p {
					font-size: 10px;
					font-weight: bold;
					text-align: center;
				}

				img {
					width: 30%;
					height: 100%;
					float: right;
				}
				
				table {
					border-spacing: 5px;
				}

				td {
					text-indent: 2px;
					text-transform: capitalize;
				}

				.head {
					background: red;
					color: white;
					text-align: center;
					text-transform: uppercase;
					font-size: 14px;
				}

				.questions {
					font-size: 12px;
					text-align: center;
				}

			</style>
			</head>
			<body>
				<h2>PT. AMALIA ROZIKIN JAYA - ARJ</h2>
				<p>INDONESIAN DOMESTIC HELPER SPECIALIST</p>
				<table>
					<tr>
						<th>REF No. 工人編號 : '.$worker['ref_number'].'</th>
					</tr>
				</table>
			
				<table width="100%" border="1">
					<tr>
						<th class="head">
							personal data
						</th>
					</tr>
				</table>
			
				<table width="100%" border="1">
					<tr>
						<th style="text-indent: 10px;">Name : '.$worker['fullname'].'</th>
					</tr>
					' .$worker_photo. '
				</table>
			
				<table width="70%" border="1">
					<tr>
						<td>Date of birth 出生日期 </td>
						<td>' .$worker['birth_date']. '</td>
						<th colspan="3" class="head">EXPERIENCE/ SKILLS 工作經驗/能力</th>
					</tr>
					<tr>
						<td>Place of birth 出生地點 </td>
						<td>'. $worker['birth_place'] .'</td>
						<td>Household 家務</td>
						<td>Yes</td>
					</tr>
					<tr>
						<td>Religion 宗教 </td>
						<td>'. $worker['religion_id'] .'</td>
						<td>Cooking 煮菜</td>
						<td></td>
					</tr>
					<tr>
						<td>Age 年領</td>
						<td></td>
						<td>Taking care elderly 照顧老人</td>
						<td></td>
					</tr>
					<tr>
						<td>Marital Status 婚姻狀況</td>
						<td></td>
						<td>Taking care children 照顧嬰兒</td>
						<td></td>
					</tr>
					<tr>
						<td>Height 身高 </td>
						<td>'. $worker['height'] .'</td>
						<td>Taking care baby 照顧小孩</td>
						<td></td>
					</tr>
					<tr>
						<td>Weight 體重</td>
						<td>'. $worker['weight'] .'</td>
						<td>Others 其他</td>
						<td></td>
					</tr>
				</table>
			
				<table width="70%" border="1">
					<tr>
						<th rowspan="4" class="head">FAMILY BACKGROUND 家庭背景</th>
					</tr>
				</table>
			
				<table width="70%" border="1">
					<tr>
						<td>Spouses name 丈夫</td>
						<td>'. $worker['spouse_name'] .'</td>
						<td>Fathers name 父親</td>
						<td>'. $worker['father_name'] .'</td>
					</tr>
			
					<tr>
						<td>Occupation 工作 </td>
						<td>'. $worker['spouse_occupation'] .'</td>
						<td>Fathers occupation 工作</td>
						<td>'. $worker['father_occupation'] .'</td>
					</tr>
			
					<tr>
						<td>Children 小孩</td>
						<td></td>
						<td>Mothers Name 母親</td>
						<td>'. $worker['mother_name'] .'</td>
					</tr>
			
					<tr>
						<td>Ages of Children 年齡</td>
						<td></td>
						<td>Mothers occupation 工作</td>
						<td>'. $worker['mother_occupation'] .'</td>
					</tr>
			
					<tr>
						<td colspan="4" style="height: 50px;">Other information 其他訊息: '. $worker['other_information'] .'</td>
					</tr>
				</table>
			
				<table width="70%" border="1">
					<tr>
						<th colspan="2" class="head">Languange Ability 語言能力</th>
						<th colspan="2" class="head">COOKING 煮食 </th>
						<th colspan="2" class="head">WORKING EX. 工作經驗</th>
					</tr>

					<tr>
						<td width="20%">English 英文</td>
						<td></td>
						<td width="20%">Chinese 中式</td>
						<td></td>
						<td>Indonesia 印尼</td>
						<td></td>
					</tr>
					
					<tr>
						<td>Cantonese 廣東話</td>
						<td></td>
						<td>Western</td>
						<td></td>
						<td>Hongkong 香港</td>
						<td></td>
					</tr>
			
					<tr>
						<td>Mandarin 國語 </td>
						<td></td>
						<td>Indonesia</td>
						<td></td>
						<td>Taiwan 台灣</td>
						<td>4 years</td>
					</tr>
			
					<tr>
						<td>Hokkian 福建話 </td>
						<td></td>
						<td rowspan="5">Home Cooking</td>
						<td rowspan="5"></td>
						<td>Singapore 新加坡</td>
						<td></td>
					</tr>
			
					<tr>
						<th colspan="2" style="font-size:12px; text-align: left;">Other 其它 :</th>
						<td>Malaysia 馬來西亞</td>
						<td></td>
					</tr>
			
					<tr>
						<th colspan="2" class="head">Education 教育程度</th>
						<td>Middle East 中東</td>
						<td></td>
					</tr>
					<tr>
						<th colspan="2">
							<p style="font-size: 12px; color: black;">'.$worker['last_education'].'</p>
								<td>Other 其他國家</td>
								<td></td>
						</th>
					</tr>
				</table>

				<table width="100%" border="1">
					<tr>
						<th align="left" style="background:red; color:white;">PREVIOUS EMPLOYMENT DETAILS 前雇主資料</th>
					</tr>
				</table>
			
				<table width="100%" border="1">
					<tr>
						<td colspan="5">Name Of Employer</td>
					</tr>
					<tr>
						<td>Working Area</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, aliquam.</td>
						<td>Country</td>
						<td>taiwan</td>
					</tr>
					<tr>
						<td>Reason of Quit</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, aliquam.</td>
						<td>Periodic</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, modi!</td>
					</tr>
					<tr style="height: 50px;">
						<td colspan="5">job content</td>
					</tr>
			
					<tr>
						<td colspan="5">name</td>
					</tr>
					<tr>
						<td>working area</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, aliquam.</td>
						<td>country</td>
						<td>taiwan</td>
					</tr>
					<tr>
						<td>reason of quir</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, aliquam.</td>
						<td>Periodic</td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, modi!</td>
					</tr>
					<tr style="height: 15px;">
						<td colspan="5">job content</td>
					</tr>
				</table>
			
				<table width="100%" border="1">
					<tr>
						<th align="left" style="background:red; color:white;">Personal Character Evaluation 女傭總體評價 </th>
					</tr>
					<tr>
						<td style="height: 15px;">
							She is studying hard Cantonese in the training center <br><br>
							<p style="font-size: 10px; color: red;">* Please note that we are not able to bear fully responsibility for this evaluation result due to human act.</p>
						</td>            
					</tr>
				</table>
			
				<table width="100%" border="1">
					<tr>
						<th colspan="2" style="background: red; color: white; text-align: left;">SUPLEMENTARY QUESTIONS 附加問題</th>
					</tr>
				</table>
			
				<table width="100%" border="1" style="text-align: center; font-size: 14px;">
					<tr>
						<th colspan="1"></th>
						<th colspan="1" style="background-color: skyblue; text-transform: uppercase;">Yes</th>
						<th colspan="1" style="background-color: skyblue; text-transform: uppercase;">No</th>
						<th rowspan="17" style="vertical-align: top;">Remark</th>
					</tr>
					<tr>
						<td>1) Will you work where there are pets?</td>
						<td>X</td>
						<td></td>
					</tr>
						
					<tr>
						<td>2) Do you have any allergies (such as skin allergy)?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>3) Do you have any knowledge in gardening?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>4) Can you handle and cook pork?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>5) Can you do eat pork?</td>
						<td>X</td>
						<td></td>
					</tr>
					<tr>
						<td>6) Can do you simple sewing?</td>
						<td></td>
						<td>X</td>
					</tr>

					<tr>
						<td>7) Dou you smoke?</td>
						<td></td>
						<td>X</td>
					</tr>

					<tr>
						<td>8) Do you drink alcohol?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>9) Can you wash car?</td>
						<td>X</td>
						<td></td>
					</tr>
						
					<tr>
						<td>10) Are you afraid of dogs?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>11) Can you bake cakes?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>12) Are you willing to take care of newly born baby?</td>
						<td></td>
						<td>X</td>
					</tr>
					<tr>
						<td>13) Are you willing to take care of invalid person?</td>
						<td>X</td>
						<td></td>
					</tr>
					<tr>
						<td>14) Are you willing to follow the code of discipline drawn up?</td>
						<td></td>
						<td>X</td>
					</tr>

					<tr>
						<td>15) Who will take care of your children if you work in HONG KONG?</td>
						<td colspan="2">My Parents</td>
					</tr>

					<tr>
						<td>16) Do you have any relatives in HONG KONG? if yes, who is she/he?</td>
						<td></td>
						<td>X</td>
					</tr>
			</table>
				';

			$pdf = new Dompdf();
			$pdf->loadHtml($content);
			$pdf->setPaper($paper_size, $orientation);
			$pdf->render();

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
