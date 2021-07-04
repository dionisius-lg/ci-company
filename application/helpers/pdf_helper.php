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

			$content =
			'<style>
				td {
					width: 20%;
					font-size: 12px;
				}
		
				table.kop.atas {
					text-align: center;
					border-bottom: 2px solid black;
				}
		
				.kop-ref {
					width: 100%;
					line-height: 5px;
					text-indent: 10px;
				}
		
				.no-ref {
					float: left;
					font-weight: bold;
				}
		
				.kop-background {
					border-bottom: 2px solid black;
					background-color: red;
					color: white;
					text-align: center;
					font-size: 12px;
					text-transform: uppercase;
				}
		
				.kop-nama {
					text-transform: uppercase;
					width: 50%;
					line-height: 1.8;
					border: 2px solid black;
					text-indent: 30px;
					border-spacing: 5px;
				}
		
				.kop-img {
					width: 50%;
					float: right;
					border-bottom: 1px solid black;
					/* position: absolute;
					left: 789.5px;
					bottom: 84px; */
				}
		
				img {
					margin-left: 100px;
					height: 200px;
					display: block;
				}
		
				.ability {
					width: 16.5%;
					border-spacing: 3px;
					border: 2px solid black;
					text-indent: 10px;
				}
		
				.experience, .family {
					width: 50%;
					text-indent: 5px;
				}
		
				.employ-detail {
					border-top: 2px solid black;
					background-color: red;
					color: white;
					text-indent: 10px;
					text-align: left;
					line-height: 20px;
					font-size: 12px;
				}
		
				.employ-body {
					text-indent: 10px;
					border: 1px solid black;
				}
			</style>
			</head>

			<body>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop atas">
				<tbody>
					<tr>
						<td>
							<h4>PT. AMALIA ROZIKIN JAYA - ARJ <br>
								INDONESIAN DOMESTIC HELPER SPECIALIST</h4>
						</td>
					</tr>
					<tr>
						<td class="kop-ref">
							<p class="no-ref">REF No. 工人編號 : ARJ HKS-029</p>
						</td>
					</tr>
				</tbody>
				</table>

				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop-background">
					<tbody>
						<tr>
							<th>
								<p>PERSONAL DATA 個人資料</p>
							</th>
						</tr>
					</tbody>
				</table>

				<table cellspacing="0" cellpadding="0" class="kop-nama">
					<tbody>
						<tr>
							<td><strong>Name 姓名 &nbsp; : ' . $worker['fullname'] . '</strong></td>
						</tr>
					</tbody>
				</table>

				<table border="1" class="kop-img">
					<tr>
						<td>' . $worker_photo .'</td>
					</tr>
				</table>

				<table class="experience" border="1" cellspacing="0" cellpadding="0">
					<tr>
						<td>Date of birth 出生日期 </td>
						<td></td>
						<th colspan="2" class="kop-background">EXPERIENCE/ SKILLS 工作經驗/能力</th>
					</tr>
					<tr>
						<td>Place of birth 出生地點</td>
						<td></td>
						<td>Household 家務</td>
						<td></td>
					</tr>
					<tr>
						<td>Religion 宗教 </td>
						<td></td>
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
						<td></td>
						<td>Taking care baby 照顧小孩</td>
						<td></td>
					</tr>
					<tr>
						<td>Weight 體重</td>
						<td></td>
						<td>Others 其他</td>
						<td></td>
					</tr>
				</table>

				<table width="50%" class="kop-background">
					<tbody>
						<tr>
							<th>FAMILY BACKGROUND 家庭背景</th>
						</tr>
					</tbody>
				</table>

				<table class="family" border="1" cellspacing="0" cellpadding="0">
					<tr>
						<td>Spouses name 丈夫</td>
						<td></td>
						<td>Fathers name 父親 </td>
						<td></td>
					</tr>
					<tr>
						<td>Occupation 工作 </td>
						<td></td>
						<td>Fathers name 父親 </td>
						<td></td>
					</tr>
					<tr>
						<td>Children 小孩</td>
						<td></td>
						<td>Mothers Name 母親</td>
						<td></td>
					</tr>
					<tr>
						<td>Ages of Children 年齡</td>
						<td></td>
						<td>Mothers Name 母親</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4" style="line-height: 30px;">
							Other information 其他訊息 :
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, ex.
						</td>
					</tr>
				</table>

				<table border="1" cellpadding="0" cellspacing="0" class="ability" style="display: inline-table;">
					<tr>
						<th colspan="2" style="background: red; color: white; font-size: 14px;">Languange Ability 語言能力</th>
					</tr>

					<tr>
						<td>English 英文</td>
						<td>V</td>
					</tr>

					<tr>
						<td>Cantonese 廣東話</td>
						<td>V</td>
					</tr>

					<tr>
						<td>Mandarin 國語 </td>
						<td>V</td>
					</tr>

					<tr>
						<td>Hokkian 福建話 </td>
						<td>V</td>
					</tr>

					<tr>
						<th colspan="2" style="font-size:12px; text-align: left;">Other 其它 :</th>
					</tr>

					<tr>
						<th colspan="2" class="kop-background">Education 教育程度</th>
					</tr>
					<tr>
						<th colspan="2">
							<p style="font-size: 12px; color: black;">Junior High School 中學</p>
						</th>
					</tr>
				</table>

				<table border="1" cellpadding="0" cellspacing="0" class="ability" style="display: inline-table;">
					<tr>
						<th colspan="2" style="background: red; color: white; font-size: 14px;">Cooking 煮食</th>
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

				<table border="1" cellpadding="0" cellspacing="0" class="ability" style="display: inline-table;">
					<tr>
						<th colspan="2" style="background: red; color: white; font-size: 14px;">Working Ex 工作經驗</th>
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
						<th colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">Name Of Employer 雇主 :</th>
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

					<tr height="50px">
						<th colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">Job Content 工作內容: works include cooking,house keeping,take care of elderly ( 84 years old ) and all general housework.</th>
					</tr>
				</table>

				<table border="1" cellpadding="0" cellspacing="0" width="100%" class="employ-body">
					<tr>
						<th colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">Name Of Employer 雇主 :</th>
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

					<tr height="50px">
						<th colspan="3" style="font-size: 12px; text-align: left; text-indent: 5px;">Job Content 工作內容: works include cooking,house keeping,take care of elderly ( 70 years old ) and all general housework.</th>
					</tr>
				</table>';

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
