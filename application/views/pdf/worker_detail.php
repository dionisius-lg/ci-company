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

            body {
                width: 100%;
                color: #000;
                font-size: 10px;
            }

            img.worker-photo {
                width: 100%;
                max-width: 220px;
                min-width: 220px;
                margin-top: 15px;
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

            .font-size-6 {
                font-size: 6px !important;
            }

            .font-size-8 {
                font-size: 8px !important;
            }

            .font-size-10 {
                font-size: 10px !important;
            }

            .font-size-12 {
                font-size: 12px !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }

            .vertical-top {
                vertical-align: top !important;
            }

            .vertical-middle {
                vertical-align: middle !important;
            }

            .vertical-botton {
                vertical-align: botton !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-left {
                text-align: left !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-right {
                text-align: right !important;
            }

            .px-0 {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .px-1 {
                padding-left: 1px !important;
                padding-right: 1px !important;
            }

            .px-2 {
                padding-left: 2px !important;
                padding-right: 2px !important;
            }

            .py-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .py-1 {
                padding-top: 1px !important;
                padding-bottom: 1px !important;
            }

            .py-2 {
                padding-top: 2px !important;
                padding-bottom: 2px !important;
            }

            .bg-red {
                color: #fff !important;
                background: #ff0000 !important;
            }

            .bg-blue {
                color: #000 !important;
                background: #EA97F1 !important;
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

            .display-block {
                display: block !important;
            }

            .display-inline-block {
                display: inline-block !important;
            }

            .display-inline {
                display: inline !important;
            }

            .display-table {
                display: table !important;
                width: 100%;
            }

            .display-table-row {
                display: table-row !important;
            }

            .display-table-cell {
                display: table-cell !important;
            }

            .text-red {
                color: #ff0000;
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

        <body id="content">
            <div class="ref-number">
                <span class="font-bold text-uppercase">Ref No.</span> <span class="font-chinese-bold">姓名</span> : <span class="font-bold text-uppercase"><?php echo $worker['ref_number']; ?></span>
            </div>
            <div class="border-top border-right border-bottom border-left px-2 text-center bg-red">
                <span class="font-bold text-uppercase">Personal Data</span> <span class="font-chinese-bold">個人資料</span>
            </div>
            <div class="border-top border-right border-bottom border-left vertical-top px-0 display-table">
                <div class="border-bottom vertical-top display-table-cell" style="width: 65%;">
                    <div class="border-bottom vertical-top px-2 py-1">
                        <span class="font-bold text-uppercase">Name</span> <span class="font-chinese-bold">姓名</span> <span class="font-bold text-uppercase"> : <?php echo $worker['fullname']; ?></span>
                    </div>
                    <div class="display-table">
                        <div class="border-bottom vertical-top px-0 display-table-cell">
                            <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="border-bottom px-2">Date of Birth <span class="font-chinese">出生日期</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo date('d/m/Y', strtotime($worker['birth_date'])); ?></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom px-2">Place of Birth <span class="font-chinese">出生日期</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo $worker['birth_place']; ?></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom px-2">Religion <span class="font-chinese">宗教</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo $worker['religion']; ?></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom px-2">Age <span class="font-chinese">年領</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo $worker['age']; ?></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom px-2">Marital Status <span class="font-chinese">婚姻狀況</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo $worker['marital_status']; ?></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom px-2">Height <span class="font-chinese">婚姻狀況</span></td>
                                    <td class="border-bottom border-left px-2"><?php echo $worker['height']; ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="px-2">Weight <span class="font-chinese">婚姻狀況</span></td>
                                    <td class="border-left px-2"><?php echo $worker['weight']; ?> kg</td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-bottom border-left vertical-top px-0 display-table-cell">
                            <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="border-botom px-2 text-center bg-red" colspan="2"><span class="font-bold text-uppercase">Experience/Skill</span> <span class="font-chinese-bold">工作經驗/能力</span></td>
                                </tr>
                                <?php $skill_experience_ids = explode(',', $worker['skill_experience_ids']);
                                if (count($skill_experiences) > 0) {
                                    $no_skill_experience = 1; $total_skill_experience = count($skill_experiences);
                                    foreach ($skill_experiences as $skill_experience) { echo
                                        '<tr>
                                            <td class="'.($no_skill_experience != $total_skill_experience ? 'border-bottom ' : '').'px-2">'.$skill_experience['name'].'<span class="font-chinese">'.$skill_experience['name_chn'].'</span></td>
                                            <td class="'.($no_skill_experience != $total_skill_experience ? 'border-bottom ' : '').'border-left px-2">'.(in_array($skill_experience['id'], $skill_experience_ids) ? 'YES' : 'NO').'</td>
                                        </tr>';
                                        $no_skill_experience++;
                                    }
                                } ?>
                            </table>
                        </div>
                    </div>
                    <div class="border-bottom vertical-top px-2 text-center bg-red">
                        <span class="font-bold text-uppercase">Family Background</span> <span class="font-chinese-bold">家庭背景</span>
                    </div>
                    <div class="border-bottom vertical-top">
                        <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="border-bottom px-2">Spouse Name <span class="font-chinese">丈夫</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['spouse_name']; ?></td>
                                <td class="border-bottom border-left px-2">Father Name <span class="font-chinese">父親</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['father_name']; ?></td>
                            </tr>
                            <tr>
                                <td class="border-bottom px-2">Occupation <span class="font-chinese">工作</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['spouse_occupation']; ?></td>
                                <td class="border-bottom border-left px-2">Father Occupation <span class="font-chinese">工作</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['father_occupation']; ?></td>
                            </tr>
                            <tr>
                                <td class="border-bottom px-2">Children <span class="font-chinese">小孩</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['children']; ?></td>
                                <td class="border-bottom border-left px-2">Mother Name <span class="font-chinese">母親</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['mother_name']; ?></td>
                            </tr>
                            <tr>
                                <td class="border-bottom px-2">Age of Children <span class="font-chinese">年齡</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['children_age']; ?></td>
                                <td class="border-bottom border-left px-2">Mother Occupation <span class="font-chinese">工作</span></td>
                                <td class="border-bottom border-left px-2"><?php echo $worker['mother_occupation']; ?></td>
                            </tr>
                            <tr>
                                <td class="px-2" width="100%%" colspan="4">
                                    Other Information <span class="font-chinese">其他訊息</span> : <?php echo $worker['full_address']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="display-table">
                        <div class="border-bottom vertical-top px-0 display-table-cell">
                            <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="border-botom px-2 text-center bg-red" colspan="2"><span class="font-bold text-uppercase">Language Ability</span> <span class="font-chinese-bold">語言能力</span></td>
                                </tr>
                                <?php $language_ability_ids = explode(',', $worker['language_ability_ids']);
                                if (count($language_abilities) > 0) {
                                    foreach ($language_abilities as $language_ability) { echo
                                        '<tr>
                                            <td class="border-bottom px-2">'.$language_ability['name'].'<span class="font-chinese">'.$language_ability['name_chn'].'</span></td>
                                            <td class="border-bottom border-left px-2">'.(in_array($language_ability['id'], $language_ability_ids) ? 'YES' : 'NO').'</td>
                                        </tr>';
                                    }
                                } ?>
                            </table>
                            <div class="border-bottom vertical-top px-2 text-center bg-red">
                                <span class="font-bold text-uppercase">Education</span> <span class="font-chinese-bold">教育程度</span>
                            </div>
                            <div class="vertical-top px-2">
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
                                <?php echo $worker['last_education']; ?> <span class="font-chinese"><?php echo $worker_last_education_china; ?></span>
                            </div>
                        </div>
                        <div class="border-bottom border-left vertical-top px-0 display-table-cell">
                            <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="border-botom px-2 text-center bg-red" colspan="2"><span class="font-bold text-uppercase">Cooking Ability</span> <span class="font-chinese-bold">煮食</span></td>
                                </tr>
                                <?php $cooking_ability_ids = explode(',', $worker['cooking_ability_ids']);
                                if (count($cooking_abilities) > 0) {
                                    foreach ($cooking_abilities as $cooking_ability) { echo
                                        '<tr>
                                            <td class="border-bottom px-2">'.$cooking_ability['name'].'<span class="font-chinese">'.$cooking_ability['name_chn'].'</span></td>
                                            <td class="border-bottom border-left px-2">'.(in_array($cooking_ability['id'], $cooking_ability_ids) ? 'YES' : 'NO').'</td>
                                        </tr>';
                                    }
                                } ?>
                            </table>
                        </div>
                        <div class="border-bottom border-left vertical-top px-0 display-table-cell">
                            <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="border-botom px-2 text-center bg-red" colspan="2"><span class="font-bold text-uppercase">Working Exp.</span> <span class="font-chinese-bold">工作經驗</span></td>
                                </tr>
                                <?php $work_experience_ids = explode(',', $worker['work_experience_ids']);
                                if (count($agency_locations) > 0) {
                                    foreach ($agency_locations as $work_experience) { echo
                                        '<tr>
                                            <td class="border-bottom px-2">'.$work_experience['name'].'<span class="font-chinese">'.$work_experience['name_chn'].'</span></td>
                                            <td class="border-bottom border-left px-2">'.(in_array($work_experience['id'], $work_experience_ids) ? 'YES' : 'NO').'</td>
                                        </tr>';
                                    }
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="border-left vertical-top text-center display-table-cell">
                    <?php echo $worker_photo; ?>
                </div>
            </div>
            <div class="border-bottom border-right border-bottom border-left px-2 text-center bg-red">
                <span class="font-bold text-uppercase">Previous Employment Detail</span> <span class="font-chinese-bold">前雇主資料</span>
            </div>
            <div class="border-bottom border-right border-bottom border-left vertical-top px-2 display-table">
                <table class="border-bottom border-right border-bottom border-left px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <?php if (count($previous_employments) > 0) { $no_employment = 1; ?>
                        <?php foreach ($previous_employments as $previous_employment) { echo
                            '<tr>
                                <td class="border-bottom px-2" colspan="2">Name of Employer <span class="font-chinese">雇主</span> : '.$previous_employment['employer_name'].'</td>
                            </tr>
                            <tr>
                                <td class="border-bottom px-2" width="50%">Working Area <span class="font-chinese">工作地點</span> : '.$previous_employment['working_area'].'</td>
                                <td class="border-bottom border-left px-2" width="50%">Country <span class="font-chinese">國家</span> : '.$previous_employment['country'].'</td>
                            </tr>
                            <tr>
                                <td class="border-bottom px-2">Reason of Quit <span class="font-chinese">終止合約/不續約原因</span> : '.$previous_employment['quit_reason'].'</td>
                                <td class="border-bottom border-left px-2">Period <span class="font-chinese">期間</span> : '.$previous_employment['period'].'</td>
                            </tr>
                            <tr>
                                <td class="'.($no_employment != count($previous_employments) ? 'border-bottom ' : '').'px-2" colspan="2" style="padding-bottom: 10px;">Job Content <span class="font-chinese"> 工作內容</span> : '.$previous_employment['job_content'].'</td>
                            </tr>';

                            $no_employment++;
                        } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="border-bottom px-2" colspan="4">Name of Employer <span class="font-chinese">雇主</span> :</td>
                        </tr>
                        <tr>
                            <td class="border-bottom px-2">Working Area <span class="font-chinese">工作地點</span></td>
                            <td class="border-bottom border-left px-2"> &nbsp; </td>
                            <td class="border-bottom border-left px-2">Country <span class="font-chinese">國家</span></td>
                            <td class="border-bottom border-left px-2"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td class="border-bottom px-2 py-2" colspan="4">Job Content <span class="font-chinese"> 工作內容</span> :</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="border-bottom border-right border-bottom border-left px-2 text-center bg-red">
                <span class="font-bold text-uppercase">Personal Character Evaluation</span> <span class="font-chinese-bold">女傭總體評價</span>
            </div>
            <div class="border-bottom border-right border-bottom border-left vertical-top px-2">
                <span class="font-bold font-size-12"><?php echo $worker['character_evaluation']; ?></span>
                <br><br>
                <span class="text-red">* Please note that we are not able to bear fully responsibility for this evaluation result due to human act</span>
            </div>
            <div class="border-bottom border-right border-bottom border-left px-2 text-center bg-red">
                <span class="font-bold text-uppercase">Suplementary Questions</span> <span class="font-chinese-bold">附加問題</span>
            </div>
            <div class="border-top border-right border-bottom border-left vertical-top px-0 display-table">
                <div class="border-bottom vertical-top display-table-cell" style="width: 75%;">
                    <?php if (count($suplementary_questions) > 0) { $no_question = 1;?>
                        <table class="px-0" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="border-bottom px-2 text-center bg-blue">Question</td>
                                <td class="border-bottom border-left px-2 text-center bg-blue">Yes</td>
                                <td class="border-bottom border-left px-2 text-center bg-blue">No</td>
                            </tr>
                            <?php foreach ($suplementary_questions as $suplementary_question) { ?>
                                <tr>
                                    <td class="border-bottom px-2" width="50%"><?php echo $no_question.'. '.$suplementary_question['question']; ?></td>
                                    <?php if ($suplementary_question['answer_type_id'] == 1) { ?>
                                        <td class="border-bottom border-left px-2 text-center" width="10%"><?php echo ($suplementary_question['answer'] == 'Yes') ? 'X' : ''; ?></td>
                                        <td class="border-bottom border-left px-2 text-center" width="10%"><?php echo ($suplementary_question['answer'] == 'No') ? 'X' : ''; ?></td>
                                    <?php } else { ?>
                                        <td class="border-bottom border-left px-2 text-center" width="20%" colspan="2"><?php echo $suplementary_question['answer']; ?></td>
                                    <?php  } ?>
                                </tr>
                            <?php $no_question++; } ?>
                        </table>
                    <?php } ?>
                </div>
                <div class="border-bottom border-left vertical-top display-table-cell">
                    <div class="border-bottom vertical-top px-2 text-center bg-blue">
                        Remark <span class="font-chinese">備註</span>
                    </div>
                    <div class="vertical-top px-2">
                        &nbsp;
                    </div>
                </div>
            </div>
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
