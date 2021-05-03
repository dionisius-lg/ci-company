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

			$content =
			'<style>
				.img-logo {
					width: 250px;
					float: left;
				}

				.img-towing {
					width: 200px;
				}

				table {
					text-align: left;
					vertical-align: center;
					margin-bottom: 10px;
					padding: 5px 50px;
				}

				table.kop.atas {
					text-align: center;
					margin-bottom: 0;
					padding-top: 0;
					padding-bottom: 0;
				}

				table.kop.atas p {
					color: navy;
					text-align: right;
					font-weight: bold;
					font-size: 18px;
					padding: 0;
				}

				table.kop.bawah {
					border-top: 2px solid #2b2b2b;
				}

                table.konten, table.catatan {
					border-collapse: collapse;
					border: 1px solid black;
				}

				table.kop.bawah td, table.konten td, table.catatan td {
					font-family: "Times New Roman", Times, serif;
					font-size: 10px;
					padding: 3px 10px;
				}

				table.kop.bawah td {
					padding-top: 1px;
					padding-bottom: 0;
					vertical-align: center;
				}

				table.konten td {
					vertical-align: center;
				}

				table ol {
					counter-reset: listCounter;
				}

				table ol .list {
					content: counter(listCounter) " . ";  
					counter-increment: listCounter;
				}

				.konten-dua {
					font-size: 10px;
					border: 1px solid black;
					padding: 5px 10px;
				}

				table .konten-dua {
					padding-top: 1px;
					padding-bottom: 0;
				}
			</style>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop atas">
				<tbody>
					<tr>
						<td>' . $company_logo .  '</td>
					</tr>
				</tbody>
			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kop bawah">
				<tbody>
					<tr>
						<td width="22%"><strong>Fullname</strong></td>
						<td width="33%"><strong>: &nbsp;' . $worker['fullname'] . '</strong></td>
					</tr>
					<tr>
						<td width=""><strong>NIK</strong></td>
						<td width=""><strong>: &nbsp;' . $worker['nik'] . '</strong></td>
					</tr>
					<tr>
						<td width=""><strong>Gender</strong></td>
						<td width=""><strong>: &nbsp;' . $worker['gender'] . '</strong></td>
					</tr>
					<tr>
						<td width=""><strong>Birth Place</strong></td>
						<td width=""><strong>: &nbsp;' . $worker['birth_place'] . '</strong></td>
					</tr>
				</tbody>
			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="konten">
				<tbody>
					<tr>
	    				<td colspan="2"><strong><u>Profile</u></strong></td>
					</tr>
					<tr>
						<td width="30%">Fullname</td>
						<td width="70%">: &nbsp;'. $worker['fullname'] . '</td>
					</tr>
					<tr>
						<td>NIK</td>
						<td>: &nbsp;' . $worker['nik'] . '</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>: &nbsp;' . $worker['gender'] . '</td>
					</tr>
					<tr>
						<td>Birth Place</td>
						<td>: &nbsp;' . $worker['birth_place'] . '</td>
					</tr>
					<tr>
						<td>Birth Date</td>
						<td>: &nbsp;' . $worker['birth_date'] . '</td>
					</tr>
					<tr>
						<td>Age</td>
						<td>: &nbsp;' . $worker['age'] . '</td>
					</tr>
					<tr>
						<td>Marital Status</td>
						<td>: &nbsp;' . $worker['marital_status'] . '</td>
					</tr>
					<tr>
						<td>Religion</td>
						<td>: &nbsp;' . $worker['religion'] . '</td>
					</tr>
				</tbody>
			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="catatan">
				<tbody>
		    		<tr>
						<td colspan="2"><strong><u>Catatan :</u></strong></td>
					</tr>
					<tr>
						<td>
							<ol class="list">
								<li>Pelanggan wajib mengecek seluruh kondisi kendaraan sebelum menyerahkan SPK ini kepada petugas derek</li>
								<li>Petugas derek wajib mengecek seluruh kondisi kendaraan setelah menerima SPK ini dan sebelum menaikkan kendaraan pelanggan ke truk derek</li>
								<li>Pelanggan wajib mengecek seluruh kondisi kendaraan setelah melakukan drop off di lokasi tujuan</li>
								<li>Petugas derek wajib mengecek seluruh kondisi kendaraan setelah melakukan drop off di lokasi tujuan</li>
							</ol>
						</td>
						<td>
							gambar bawah
						</td>
					</tr>
				</tbody>
			</table>';

			$pdf = new Dompdf();
			$pdf->loadHtml($content);
			$pdf->setPaper($paper_size, $orientation);
			$pdf->render();

			$output = $pdf->output();

			$filepath = 'files/workers/' . $worker['id'] . '/';
			$filename = 'worker_' . $worker['nik'] . '.pdf';

			file_put_contents($filepath.$filename, $output);

			$result = [
				'filepath'	=> $filepath.$filename,
				'fileurl'	=> base_url($filepath.$filename)
			];
		}

		return $result;
	}
}
