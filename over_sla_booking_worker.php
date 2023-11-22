<?php

require __DIR__ . '/application/libraries/phpscript/config.php';
require __DIR__ . '/application/libraries/phpscript/database.php';
require __DIR__ . '/application/libraries/phpscript/function.php';

$status = @$_SERVER['argv'][1];

// get workers data
$condition = [
    'booking_status_id IN (2,3)',
    'booking_date IS NOT NULL',
];

$workers = dbget('view_workers', [], $condition);

if (count($workers) > 0) {
    foreach ($workers as $worker) {
        $current_date = date('Y-m-d H:i:s');
        $start_date = date('Y-m-d H:i:s', strtotime($worker['booking_date']));

        $working_hour = $config['working_hour'];

        $get_second = getWorkingEverydaySeconds($start_date, $current_date, [], $working_hour);

        // if over than 3 days in second
        if ($get_second > 259200) {
            $data = [
                'booking_status_id' => 1,
                'booking_user_id' => null,
                'booking_date' => null,
                'is_over_sla' => 1
            ];

            $update = dbupdate('workers', ['id' => $worker['id']], $data);

            if ($update) {
                echo 'Update worker ' . $status . ' id: ' . $worker['id'];
                echo PHP_EOL;

                createLog($config['log']['dir'] . $config['log']['success'], basename($_SERVER['SCRIPT_FILENAME']) . ' - Success update workers over sla booking. Worker ID: ' . $worker['id']);
            } else {
                createLog($config['log']['dir'] . $config['log']['error'], basename($_SERVER['SCRIPT_FILENAME']) . ' - Can\'t update workers over sla booking. Worker ID: ' . $worker['id']);
            }
        }
    }
}