<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!function_exists('PdfWorkerDetail')) {
    function PdfWorkerDetail($worker_id = false, $paper_size = 'A4', $orientation = 'portrait') {
        $ci = &get_instance();
        $result = false;
        $data = [];

        if ($worker_id && is_numeric($worker_id)) {
            // load required models
            $ci->load->model('AgencyLocationsModel');
            $ci->load->model('CompanyModel');
            $ci->load->model('CookingAbilitiesModel');
            $ci->load->model('LanguageAbilitiesModel');
            $ci->load->model('SkillExperiencesModel');
            $ci->load->model('SuplementaryQuestionsModel');
            $ci->load->model('WorkersModel');
            $ci->load->model('WorkerPreviousEmploymentsModel');
            $ci->load->model('WorkerSuplementaryQuestionsModel');

            $request = [
                'worker' => $ci->WorkersModel->getDetail($worker_id),
                'skill_experiences' => $ci->SkillExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
                'cooking_abilities' => $ci->CookingAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
                'language_abilities' => $ci->LanguageAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
                'agency_locations' => $ci->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
                'suplementary_questions' => $ci->WorkerSuplementaryQuestionsModel->getAll(['order' => 'question', 'limit' => 1000]),
                'previous_employments' => $ci->WorkerPreviousEmploymentsModel->getAll(['order' => 'period', 'sort' => 'desc', 'limit' => 100, 'worker_id' => $worker_id]),
                'company' => $ci->CompanyModel->get(),
            ];

            foreach ($request as $key => $val) {
                $data[$key] = [];
    
                if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                    if ($request[$key]['status'] == 'success') {
                        $data[$key] = $val['data'];
                    }
                }
            }

            if (!empty($data['worker'])) {
                $data['worker_photo'] = '<img class="worker-photo" src="'.((file_exists(FCPATH.'files/workers/'.$data['worker']['id'].'/'.$data['worker']['photo'])) ? FCPATH.'files/workers/'.$data['worker']['id'].'/'.$data['worker']['photo'] : FCPATH.'assets/img/default-avatar.jpg').'" alt="Worker Photo">';

                $content = $ci->load->view('pdf/worker_detail', $data, true);

                // config and render dompdf
                $pdf = new Dompdf();
                $pdf->getOptions()->setIsFontSubsettingEnabled(true);
                $pdf->loadHtml($content);
                $pdf->setPaper($paper_size, $orientation);
                $pdf->render();

                $output = $pdf->output();

                $filepath = 'files/workers/'.$data['worker']['id'].'/';

                if (!is_dir('./'.$filepath)) {
                    mkdir('./'.$filepath, 0777, true);
                }

                $filename = 'biodata_'.base64url_encode($data['worker']['id']).'.pdf';

                file_put_contents($filepath.$filename, $output);

                $result = [
                    'filepath'    => $filepath.$filename,
                    'fileurl'    => base_url($filepath.$filename)
                ];
            }
        }

        return $result;
    }
}
