<?php

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
 *  getClientIp method
 *  get client's IP Address from request
 *  @return string $ipaddress
 */
function getClientIp()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/**
 *  filterParamString method
 *  filter get parameter value for safe sql query
 *  @param string $value
 *  @return string $result
 */
function filterParamString($value)
{
    $result = preg_replace("/[^a-zA-Z0-9 +]+/", "", $value);

    return $result;
}

/**
 *  filterParamNumber method
 *  filter get parameter value for safe sql query
 *  @param string $value
 *  @return string $result
 */
function filterParamNumber($value)
{
    $result = preg_replace("/[^0-9]+/", "", $value);

    return $result;
}

/**
 *  filterFilename method
 *  @param string $string, string $replacement
 *  @return string $filename
 */
function filterFilename($string, $replacement = '-')
{
    $entries = array('\\', '/', '?', ':', '*', '"', '>', '<', '|');
    $filename = str_replace($entries, $replacement, preg_replace('/\s+/', '_', trim($string)));

    return $filename;
}

/**
 *  executionTime method
 *  count request execution time (in seconds)
 *  @param int $request_time
 *  @return int $time
 */
function executionTime($request_time)
{
    $time = ((time() - $request_time) % 86400) % 60;

    return $time;
}

/**
 *  getWeekendDays method
 *  count weekend days between date
 *  @param string $start_date, string $end_date
 *  @return array $working_days
 */
function getWeekendDays($start_date = null, $end_date = null)
{
    $day = 86400; // Day in seconds

    $sTime = strtotime($start_date); // Start as time
    $eTime = strtotime($end_date); // End as time
    $numDays = round(($eTime - $sTime) / $day) + 1;

    $working_days = [];

    for ($d = 0; $d < $numDays; $d++) {
        $day_number = date('N', ($sTime + ($d * $day)));
        $weekend_numbers = [6, 7];
        $date = date('Y-m-d', ($sTime + ($d * $day)));

        if (in_array($day_number, $weekend_numbers)) {
            $weekend_days[] = $date;
        }
    }

    return $weekend_days;
}

/**
 *  getWorkingDays method
 *  count working days between date
 *  @param string $start_date, string $end_date, array $holidays
 *  @return array $working_days
 */
function getWorkingDays($start_date = null, $end_date = null, $holidays = [])
{
    $day = 86400; // Day in seconds

    $sTime = strtotime($start_date); // Start as time
    $eTime = strtotime($end_date); // End as time
    $numDays = round(($eTime - $sTime) / $day) + 1;

    $working_days = [];

    for ($d = 0; $d < $numDays; $d++) {
        $day_number = date('N', ($sTime + ($d * $day)));
        $weekend_numbers = [6, 7];
        $date = date('Y-m-d', ($sTime + ($d * $day)));

        if (!in_array($day_number, $weekend_numbers) && !in_array($date, $holidays)) {
            $working_days[] = $date;
        }
    }

    return $working_days;
}

/**
 *  getWorkingHours method
 *  count working hours between datetime
 *  @param string $start_date, string $end_date, array $holidays, array $config_hour
 *  @return int $working_hours
 */
function getWorkingHours($start_date, $end_date, $holidays = [], $config_hour = [])
{
    // saturday sunday
    $sat_san = [6, 7];

    // timestamps
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);

    // work day seconds
    $workday_start_hour = (!empty($config_hour['start']) ? $config_hour['start'] : 9); // default start working hour: 9
    $workday_end_hour = (!empty($config_hour['end']) ? $config_hour['end'] : 17); // default start working hour: 17
    $workhour_count = $workday_end_hour - $workday_start_hour;
    $workday_arr = [];

    $hour_range = range($workday_start_hour, $workday_end_hour);

    // work days beetwen dates, minus 1 day
    $start_date = date('Y-m-d', $start_timestamp);
    $end_date = date('Y-m-d', $end_timestamp);

    $start_index = date('N', $start_timestamp);
    $end_index = date('N', $end_timestamp);

    $start_hour = date('H', $start_timestamp);
    $end_hour = date('H', $end_timestamp);

    $date_list = getWorkingDays($start_date, $end_date, $holidays);
    $workdays_number = count($date_list);

    $working_hours = 0;

    if ($workdays_number >= 1) {
        $start_date_start_hour = 0;
        $start_date_end_hour = 0;
        if (!in_array($start_index, $sat_san) && !in_array($start_index, $holidays) && $start_hour <= $workday_end_hour) {
            $start_date_start_hour = (in_array(date('H', $start_timestamp), $hour_range) ? date('H', $start_timestamp) : $hour_range[0]);
            $start_date_end_hour = end($hour_range);
        }

        $end_date_start_hour = 0;
        $end_date_end_hour = 0;
        if (!in_array($end_index, $sat_san) && !in_array($end_index, $holidays) && $end_hour >= $workday_start_hour) {
            $end_date_start_hour = $hour_range[0];
            $end_date_end_hour = (in_array(date('H', $end_timestamp), $hour_range) ? date('H', $end_timestamp) : end($hour_range));
        }

        $edge_hour = ($start_date_end_hour - $start_date_start_hour) + ($end_date_end_hour - $end_date_start_hour);

        if ($workdays_number == 1 && $start_date == $end_date) {
            $edge_hour = $end_date_end_hour - $start_date_start_hour;
        }

        $middle_hour = 0;

        if ($workdays_number > 1) {
            $max_index = $workdays_number - 1;

            if ($date_list[0] == $start_date) {
                unset($date_list[0]);
            }

            if (end($date_list) == $end_date) {
                unset($date_list[$max_index]);
            }

            $middle_hour = count($date_list)*$workhour_count;
        }

        $working_hours = $edge_hour + $middle_hour;
    }

    return $working_hours;
}

/**
 *  getWorkingSeconds method
 *  count working hours between datetime
 *  @param string $start_date, string $end_date, array $holidays, array $config_hour
 *  @return int $working_seconds
 */
function getWorkingSeconds($start_date, $end_date, $holidays = [], $config_hour = [])
{
    // saturday sunday
    $sat_san = [6, 7];

    // timestamps
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);

    // work day seconds
    $workday_start_hour = (!empty($config_hour['start']) ? $config_hour['start'] :9);
    $workday_end_hour = (!empty($config_hour['end']) ? $config_hour['end'] : 17);
    $workhour_count = $workday_end_hour - $workday_start_hour;
    $workday_arr = [];

    $hour_range = range($workday_start_hour, $workday_end_hour);

    // work days beetwen dates
    $start_date = date('Y-m-d', $start_timestamp);
    $end_date = date('Y-m-d', $end_timestamp);

    $start_index = date('N', $start_timestamp);
    $end_index = date('N', $end_timestamp);

    $start_hour = date('H', $start_timestamp);
    $end_hour = date('H', $end_timestamp);

    $date_list = getWorkingDays($start_date, $end_date, $holidays);
    $workdays_number = count($date_list);

    $working_seconds = 0;

    if ($workdays_number >= 1) {
        $start_date_start_hour = 0;
        $start_date_end_hour = 0;

        if (!in_array($start_index, $sat_san) && !in_array($start_date, $holidays) && $start_hour < $workday_end_hour) {
            $start_lowest_dt = date('Y-m-d H:i:s', strtotime('+'.$hour_range[0].' hour', strtotime($start_date)));
            $start_highest_dt = date('Y-m-d H:i:s', strtotime('+'.end($hour_range).' hour', strtotime($start_date)));
            $start_date_start_hour = (in_array(date('H', $start_timestamp), $hour_range) ? $start_timestamp : strtotime($start_lowest_dt));
            $start_date_end_hour = strtotime($start_highest_dt);
        }

        $end_date_start_hour = 0;
        $end_date_end_hour = 0;

        if (!in_array($end_index, $sat_san) && !in_array($end_date, $holidays) && $end_hour >= $workday_start_hour) {
            $end_lowest_dt = date('Y-m-d H:i:s', strtotime('+'.$hour_range[0].' hour', strtotime($end_date)));
            $end_highest_dt = date('Y-m-d H:i:s', strtotime('+'.end($hour_range).' hour', strtotime($end_date)));
            $end_date_start_hour = strtotime($end_lowest_dt);
            $end_date_end_hour = (in_array(date('H', $end_timestamp), $hour_range) ? $end_timestamp : strtotime($end_highest_dt));
        }

        $edge_hour = ($start_date_end_hour - $start_date_start_hour) + ($end_date_end_hour - $end_date_start_hour);

        // if start_date equal to end_date
        if ($workdays_number == 1 && $start_date == $end_date) {
            $edge_hour = $end_date_end_hour - $start_date_start_hour;

            // if both start and end hour is out of working hour or if start hour begin from the end of hour range
            if ((!in_array($start_hour, $hour_range) && !in_array($end_hour, $hour_range)) || $start_hour == end($hour_range)) {
                $edge_hour = 0;
            }
        }

        $middle_hour = 0;

        if ($workdays_number > 1) {
            $max_index = $workdays_number - 1;

            if ($date_list[0] == $start_date) {
                unset($date_list[0]);
            }

            if (end($date_list) == $end_date) {
                unset($date_list[$max_index]);
            }

            $middle_hour = (count($date_list)*$workhour_count) * 3600;
        }

        $working_seconds = $edge_hour + $middle_hour;
    }

    return $working_seconds;
}

/**
 *  getWorkingEverydaySeconds method
 *  count working hours between datetime
 *  @param string $start_date, string $end_date, array $holidays, array $config_hour
 *  @return int $working_seconds
 */
function getWorkingEverydaySeconds($start_date, $end_date, $holidays = [], $config_hour = [])
{
    // timestamps
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);

    // work day seconds
    $workday_start_hour = (!empty($config_hour['start']) ? $config_hour['start'] : 9);
    $workday_end_hour = (!empty($config_hour['end']) ? $config_hour['end'] : 18);
    $workhour_count = $workday_end_hour - $workday_start_hour;
    $workday_arr = [];

    $hour_range = range($workday_start_hour, $workday_end_hour);

    // work days beetwen dates
    $start_date = date('Y-m-d', $start_timestamp);
    $end_date = date('Y-m-d', $end_timestamp);

    $start_index = date('N', $start_timestamp);
    $end_index = date('N', $end_timestamp);

    $start_hour = date('H', $start_timestamp);
    $end_hour = date('H', $end_timestamp);

    $day_interval = [];

    for ($i=$start_timestamp; $i<=$end_timestamp; $i+=86400) {
        $day_interval[] = date('Y-m-d', $i);
    }

    $workdays_number = count($day_interval) - count($holidays);
    $date_list = array_diff($day_interval, $holidays);

    $working_seconds = 0;

    if ($workdays_number >= 1) {
        $start_date_start_hour = 0;
        $start_date_end_hour = 0;

        if (!in_array($start_index, $holidays) && $start_hour < $workday_end_hour) {
            $start_lowest_dt = date('Y-m-d H:i:s', strtotime('+'.$hour_range[0].' hour', strtotime($start_date)));
            $start_highest_dt = date('Y-m-d H:i:s', strtotime('+'.end($hour_range).' hour', strtotime($start_date)));
            $start_date_start_hour = (in_array(date('H', $start_timestamp), $hour_range) ? $start_timestamp : strtotime($start_lowest_dt));
            $start_date_end_hour = strtotime($start_highest_dt);
        }

        $end_date_start_hour = 0;
        $end_date_end_hour = 0;

        if (!in_array($end_index, $holidays) && $end_hour >= $workday_start_hour) {
            $end_lowest_dt = date('Y-m-d H:i:s', strtotime('+'.$hour_range[0].' hour', strtotime($end_date)));
            $end_highest_dt = date('Y-m-d H:i:s', strtotime('+'.end($hour_range).' hour', strtotime($end_date)));
            $end_date_start_hour = strtotime($end_lowest_dt);
            $end_date_end_hour = (in_array(date('H', $end_timestamp), $hour_range) ? $end_timestamp : strtotime($end_highest_dt));
        }

        $edge_hour = ($start_date_end_hour - $start_date_start_hour) + ($end_date_end_hour - $end_date_start_hour);

        // if start_date equal to end_date
        if ($workdays_number == 1 && $start_date == $end_date) {
            $edge_hour = $end_date_end_hour - $start_date_start_hour;

            // if both start and end hour is out of working hour or if start hour begin from the end of hour range
            if ((!in_array($start_hour, $hour_range) && !in_array($end_hour, $hour_range)) || $start_hour == end($hour_range)) {
                $edge_hour = 0;
            }
        }

        $middle_hour = 0;

        if ($workdays_number > 1) {
            $max_index = $workdays_number - 1;

            if ($date_list[0] == $start_date) {
                unset($date_list[0]);
            }

            if (end($date_list) == $end_date) {
                unset($date_list[$max_index]);
            }

            $middle_hour = (count($date_list)*$workhour_count) * 3600;
        }

        $working_seconds = $edge_hour + $middle_hour;
    }

    return $working_seconds;
}

/**
 *  getHourMinuteSecond method
 *  convert seconds to hour, minute, second
 *  @param int $seconds
 *  @return array $hms
 */
function getSecondsToTime($seconds)
{
    $seconds = $seconds;
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;

    $hms = [
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds
    ];

    return $hms;
}
