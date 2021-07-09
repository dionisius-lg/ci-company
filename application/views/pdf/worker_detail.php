<!doctype html>
<html>
	<head>
        <meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PDF Document</title>

		<style>
			@font-face {
				font-family: 'Chinese';
				src: url(<?php echo base_url('assets/font/pdf/fireflysung.ttf'); ?>) format('truetype');
			}

			@font-face {
				font-family: 'Chinese Bold';
				src: url('<?php echo base_url('assets/font/pdf/Kai-Bold.ttf'); ?>') format('truetype');
			}

			.font-chinese {
				font-family: 'Chinese' !important;
			}

			.font-chinese-bold {
				font-family: 'Chinese Bold' !important;
			}

			.font-bold {
				font-weight: 600 !important;
			}

			.text-uppercase {
				text-transform: uppercase !important;
			}

			.text-center {
				text-align: center !important;
			}

			.px {
				padding-left: 1px !important;
				padding-right: 1px !important;
			}

			.border-top {
				border-top: 1px solid black !important;
			}

			.border-right {
				border-right: 1px solid black !important;
			}

			.border-bottom {
				border-bottom: 1px solid black !important;
			}

			.border-left {
				border-left: 1px solid black !important;
			}

			.text-red {
				color: #ff0000;
			}

			body {
				color: #000;
				font-size: 6px;
			}

			#header, #content, #footer {
				width: 100% !important;
			}

			#header h2 {
				font-size: 16px;
			}

			#header h2 span {
				display: block;
				font-size: 10px;
				font-weight: 300;
				letter-spacing: 0;
			}

			#content .ref-number {
				font-size: 10px;
			}

			#content table {
				vertical-align: center;
				border-collapse: collapse;
				width: 100% !important;
				padding: 0;
			}

			#content table td {
				color: #000;
				text-align: left;
				font-size: 10px;
				background-color: #fff;
				border: none;
				padding: 0;
				vertical-align: top;
			}

			#content table td.red {
				color: #fff;
				background: #ff0000;
			}

			#footer {
				padding-top: 5px;
				font-size: 10px;
			}
		</style>
	</head>
	<body>
		<div id="header" class="text-uppercase text-center">
			<h2><?php echo $company['name']; ?><span>Indonesian Domestic Helper Specialist</span></h2>
		</div>

		<div id="content">
			<div class="ref-number">
				<span class="font-bold text-uppercase">Ref No.</span> <span class="font-chinese-bold">姓名</span> : <span class="font-bold text-uppercase"><?php echo $worker['ref_number']; ?></span>
			</div>
			<table class="border-top border-right border-bottom border-left" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="border-top border-right border-bottom border-left px red text-center" width="100%" colspan="2"><span class="font-bold text-uppercase">Personal Data</span> <span class="font-chinese-bold">個人資料</span></td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left px" width="85%"><span class="font-bold">NAME</span> <span class="font-chinese-bold-bold">姓名</span> <span class="font-bold text-uppercase"> : <?php echo $worker['fullname']; ?></span></td>
					<td class="border-top border-right border-bottom border-left px" width="15%" rowspan="5">Photo</td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left" width="85%">
						<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="border-bottom px" width="25%">Date of Birth <span class="font-chinese">出生日期</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo date('d/m/Y', strtotime($worker['birth_date'])); ?></td>
								<td class="border-bottom border-left px red text-center" width="50%"><span class="font-bold text-uppercase">Experience/Skill</span> <span class="font-chinese-bold">工作經驗/能力</span></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Place of Birth <span class="font-chinese">出生日期</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['birth_place']; ?></td>
								<td class="border-left" width="50%" rowspan="6">
									<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
										<?php $skill_experience_ids = explode(',', $worker['skill_experience_ids']);
										if (count($skill_experiences) > 0) {
											foreach ($skill_experiences as $skill_experience) { echo
												'<tr>
													<td class="border-bottom px" width="70%">'.$skill_experience['name'].'<span class="font-chinese">'.$skill_experience['name_chn'].'</span></td>
													<td class="border-bottom border-left px" width="30%">'.(in_array($skill_experience['id'], $skill_experience_ids) ? 'YES' : 'NO').'</td>
												</tr>';
											}
										} ?>
									</table>
								</td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Religion <span class="font-chinese">宗教</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['religion']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Age <span class="font-chinese">年領</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['age']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Marital Status <span class="font-chinese">婚姻狀況</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['marital_status']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Height <span class="font-chinese">婚姻狀況</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['height']; ?> cm</td>
							</tr>
							<tr>
								<td class="px-5 py-3" width="25%">Weight <span class="font-chinese">婚姻狀況</span></td>
								<td class="border-left px" width="25%"><?php echo $worker['weight']; ?> kg</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left px red text-center" width="85%"><span class="font-bold text-uppercase">Family Background</span> <span class="font-chinese-bold">家庭背景</span></td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left" width="85%">
						<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="border-bottom px" width="25%">Spouse Name <span class="font-chinese">丈夫</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['spouse_occupation']; ?></td>
								<td class="border-bottom border-left px" width="25%">Father Name <span class="font-chinese">父親</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['father_name']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Occupation <span class="font-chinese">工作</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['spouse_name']; ?></td>
								<td class="border-bottom border-left px" width="25%">Father Occupation <span class="font-chinese">工作</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['father_occupation']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Children <span class="font-chinese">小孩</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['children']; ?></td>
								<td class="border-bottom border-left px" width="25%">Mother Name <span class="font-chinese">母親</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['mother_name']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom px" width="25%">Age of Children <span class="font-chinese">年齡</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['children_age']; ?></td>
								<td class="border-bottom border-left px" width="25%">Mother Occupation <span class="font-chinese">工作</span></td>
								<td class="border-bottom border-left px" width="25%"><?php echo $worker['mother_occupation']; ?></td>
							</tr>
							<tr>
								<td class="px-5 px" width="100%%" colspan="4">
									Other Information <span class="font-chinese">其他訊息</span> : <?php echo $worker['full_address']; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left" width="85%">
						<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="border-bottom px red text-center" width="30%"><span class="font-bold text-uppercase">Language Ability</span> <span class="font-chinese-bold">語言能力</span></td>
								<td class="border-bottom border-left px red text-center" width="30%"><span class="font-bold text-uppercase">Cooking Ability</span> <span class="font-chinese-bold">煮食</span></td>
								<td class="border-bottom border-left px red text-center" width="40%"><span class="font-bold text-uppercase">Working Exp.</span> <span class="font-chinese-bold">工作經驗</span></td>
							</tr>
							<tr>
								<td class="border-right border-left" width="30%">
									<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
										<?php $language_ability_ids = explode(',', $worker['language_ability_ids']);
										if (count($language_abilities) > 0) {
											foreach ($language_abilities as $language_ability) { echo
												'<tr>
													<td class="border-bottom px" width="70%">'.$language_ability['name'].'<span class="font-chinese">'.$language_ability['name_chn'].'</span></td>
													<td class="border-bottom border-left px" width="30%">'.(in_array($language_ability['id'], $language_ability_ids) ? 'YES' : 'NO').'</td>
												</tr>';
											}
										} ?>
										<tr>
											<td class="border-bottom px red text-center" width="100%" colspan="2"><span class="font-bold text-uppercase">Education</span> <span class="font-chinese-bold">教育程度</span></td>
										</tr>
										<?php switch ($worker['last_education_id']) {
											case 1:
												$worker_last_education_china = '幼兒園'; break;
											case 2:
												$worker_last_education_china = '小學'; break;
											case 3:
												$worker_last_education_china = '初中'; break;
											case 4:
												$worker_last_education_china = '高中'; break;
											case 5:
												$worker_last_education_china = '學歷學位'; break;
											case 6:
												$worker_last_education_china = '學士文憑'; break;
											case 7:
												$worker_last_education_china = '其他'; break;
											default:
												$worker_last_education_china = ''; break;
										} ?>
										<tr>
											<td class="px-5 py-3" width="100%" colspan="2"><?php echo $worker['last_education']; ?> <span class="font-chinese"><?php echo $worker_last_education_china; ?></span></td>
										</tr>
									</table>
								</td>
								<td class="border-right border-left" width="30%">
									<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
										<?php $cooking_ability_ids = explode(',', $worker['cooking_ability_ids']);
										if (count($cooking_abilities) > 0) {
											foreach ($cooking_abilities as $cooking_ability) { echo
												'<tr>
													<td class="border-bottom px" width="70%">'.$cooking_ability['name'].'<span class="font-chinese">'.$cooking_ability['name_chn'].'</span></td>
													<td class="border-bottom border-left px" width="30%">'.(in_array($cooking_ability['id'], $cooking_ability_ids) ? 'YES' : 'NO').'</td>
												</tr>';
											}
										} ?>
									</table>
								</td>
								<td class="border-left" width="40%">
									<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
										<?php $work_experience_ids = explode(',', $worker['work_experience_ids']);
										if (count($agency_locations) > 0) {
											foreach ($agency_locations as $work_experience) { echo
												'<tr>
													<td class="border-bottom px" width="70%">'.$work_experience['name'].'<span class="font-chinese">'.$work_experience['name_chn'].'</span></td>
													<td class="border-bottom border-left px" width="30%">'.(in_array($work_experience['id'], $work_experience_ids) ? 'YES' : 'NO').'</td>
												</tr>';
											}
										} ?>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left px red text-center" width="100%" colspan="2"><span class="font-bold text-uppercase">Previous Employment Detail</span> <span class="font-chinese-bold">前雇主資料</span></td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left" width="100%" colspan="2">
						<?php if (count($previous_employments) > 0) { ?>
							<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
								<?php foreach ($previous_employments as $previous_employment) { echo
									'<tr>
										<td class="border-bottom px" width="100%" colspan="4">Name of Employer <span class="font-chinese">雇主</span> : '.$previous_employment['employer_name'].'</td>
									</tr>
									<tr>
										<td class="border-bottom px" width="25%">Working Area <span class="font-chinese">工作地點</span></td>
										<td class="border-bottom border-left px" width="25%">'.$previous_employment['working_area'].'</td>
										<td class="border-bottom border-left px" width="25%">Country <span class="font-chinese">國家</span></td>
										<td class="border-bottom border-left px" width="25%">'.$previous_employment['country'].'</td>
									</tr>
									<tr>
										<td class="border-bottom px" width="25%">Reason of Quit <span class="font-chinese">終止合約/不續約原因</span></td>
										<td class="border-bottom border-left px" width="25%">'.$previous_employment['quit_reason'].'</td>
										<td class="border-bottom border-left px" width="25%">Period <span class="font-chinese">期間</span></td>
										<td class="border-bottom border-left px" width="25%">'.$previous_employment['period'].'</td>
									</tr>
									<tr>
										<td class="border-bottom px" width="100%" colspan="4">Job Content <span class="font-chinese"> 工作內容</span> : '.$previous_employment['job_content'].'</td>
									</tr>';
								} ?>
								</table>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left px red text-center" width="100%" colspan="2"><span class="font-bold text-uppercase">Personal Character Evaluation</span> <span class="font-chinese-bold">女傭總體評價</span></td>
				</tr>
				<tr>
					<td class="border-top border-right border-bottom border-left px" width="100%" colspan="2">
						<?php echo $worker['character_evaluation']; ?>
						<br><br><span class="text-red">* Please note that we are not able to bear fully responsibility for this evaluation result due to human act</span>
					</td>
				</tr>
			</table>
		</div>

		<div id="footer">
			<div>
				<span class="font-bold text-uppercase">Disclaimer :</span> All data and Information shown in this biodata is provided by the applicant. PT is not responsible for any losses and damages caused by any discrepancy and incorrectness of the information and data provided by applicants in this biodata. Clients should verify by themselves the related information during the interviews and screenings.No guarantee for the authenticity of the helpers' personal data is hereby given by PT.
			</div>
			<div class="font-chinese">
				<span class="font-chinese-bold">免責聲明 :</span> <span class="font-chinese">以上資料由申請人提供 學校不會因申請人提供資料的準確性而導致的損失作出任何的賠償. 僱主需要在面試及甄選過程中自行核實相關資料. 學校不會對申請人所提供的資料的真實性作出任何賠償. 香港僱傭中心為得到我司允許也不得改變任何內容, 以避免產生誤會以及其所導致的法律責任.</span>
			</div>
		</div>
	</body>
</html>
