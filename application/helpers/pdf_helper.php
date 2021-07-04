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
			'<style>        table .ability .cooking .working {
				table-layout: fixed;
			}
	
			td {
				width: 20%;
				font-size: 12px;
			}
			
			table.kop.atas {
				text-align: center;
				border-bottom: 2px solid black;
			}
	
			.kop-ref{
				width: 100%;
				line-height: 5px;
				text-indent: 5px;
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
				line-height: 1.8;
				text-indent: 20px;
				font-size: 13px;
				font-family: Tahoma, Geneva, Verdana, sans-serif;
			}
	
			.kop-nama {
				text-transform: uppercase;
				font-size: 14px;
				width: 50%;
				line-height: 1.8;
				border: 1px solid black;
				text-indent: 30px;
			}
	
			.experience, .family {
				table-layout: auto;
				width: 50%;
				font-size: 13px;
			}
	
			.heading-tiga th {
				text-indent: 20px;
				font-size: 14px;
				color: white;
				background-color: red;
				text-align: center;
				width: 259px;
			}
	
			.ability {
				border: 1px solid black;
				width: 265px;
				line-height: 20px;
			}
	
			.cooking {
				border: 1px solid black;
				width: 259px;
				line-height: 20px;
				margin-left: 265px;
				position: relative;
				bottom: 160px;
				height: 40px;
			}
	
			.working {
				border: 1px solid black;
				width: 259px;
				line-height: 20px;
				margin-left: 524px;
				margin-top: -1px;
				position: relative;
				bottom: 320px;
			}
	
			.kop-employ {
				border-top: 2px solid black;
				margin-top: -300px;
				background-color: red;
				color: white;
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
					<th><p>PERSONAL DATA 個人資料</p></th>
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
	
		<div class="kop-img" style="width: 30%; float: right; position: relative; right: 200px; left: 0;">
			' . $worker_photo . '
		</div>
	
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
	
		<table class="heading-tiga" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<th>LANGUAGE ABILITY 語言能力</th>
				<th>COOKING 煮食</th>
				<th>WORKING EX. 工作經驗</th>
			<tr>
		</table>
		
		<table class="ability" cellspacing="0" cellpadding="0">
			<tr>
				<td>English 英文</td>
				<td>X</td>
			</tr>
		</table>
	
		<table class="ability" cellspacing="0" cellpadding="0">
			<tr>
				<td>Cantonese 廣東話</td>
				<td>X</td>
			</tr>
		</table>
	
		<table class="ability" cellspacing="0" cellpadding="0">
			<tr>
				<td>Mandarin 國語</td>
				<td>X</td>
			</tr>
		</table>
	
		<table class="ability" cellspacing="0" cellpadding="0">
			<tr>
				<td>Hokkian 福建話</td>
				<td>X</td>
			</tr>
		</table>
	
		<table class="ability" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2">Other其它 : </td>
			</tr>
		</table>
	
		<table style="background-color: red; color: white;" cellspacing="0" cellpadding="0">
			<tr>
				<th width="265px">EDUCATION 教育程度</th>
			</tr>
		</table>
	
		<table class="ability" border="1" cellspacing="0" cellpadding="0">
			<td colspan="2">Junior High School 中學</td>
		</table>
		
		<table class="cooking" cellspacing="0" cellpadding="0">
			<tr>
				<td>Chinese 中式</td>
				<td>V</td>
			</tr>
		</table>
	
		<table class="cooking" cellspacing="0" cellpadding="0">
			<tr>
				<td>Western 西式</td>
				<td>V</td>
			</tr>
		</table>
	
		<table class="cooking" cellspacing="0" cellpadding="0">
			<tr>
				<td>Indonesian 印尼菜</td>
				<td>V</td>
			</tr>
		</table>
	
		<table class="cooking" cellspacing="0" cellpadding="0">
			<tr>
				<td>Home Cooking 家常菜</td>
				<td>V</td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Indonesia 印尼</td>
				<td>lll</td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Hongkong 香港</td>
				<td>lll</td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Taiwan 台灣 </td>
				<td>9 Years</td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Singapore 新加坡</td>
				<td></td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Singapore 新加坡</td>
				<td></td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Middle East 中東</td>
				<td></td>
			</tr>
		</table>
	
		<table class="working" cellspacing="0" cellpading="0">
			<tr>
				<td>Other 其他國家</td>
				<td></td>
			</tr>
		</table>
		
		<table class="kop-employ" width="100%">
			<tr style="text-align: center;">
				<th>PREVIOUS EMPLOYMENT DETAILS 前雇主資料</th>
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
