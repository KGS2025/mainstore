<?php

$filename = "Users_List_Front_Door.csv";
header('Content-Type: text/csv; charset=UTF-8; encoding=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$fp = fopen('php://output', 'wb');
fputcsv($fp, array('No.', 'IP Address', 'Time Surfing', 'Date', 'Applicant', 'Email', 'Country', 'Cellphone'));
$srno = 1;

foreach ($all_data as $ad) {
    $a = array();
    $a[] = $srno;
    $a[] = $ad['ip_address'];
    $ts = '';
    if (isset($ad['timezone']) && $ad['timezone'] != '') {
        $timezone = $ad['timezone'];
    } else {
        $timezone = 'America/Los_Angeles';
    }
    if (isset($ad['sessionendtime']) && $ad['sessionendtime'] != '') {
        $default_timezone = date_default_timezone_get();
        $date = date('Y-m-d H:i:s', $ad['created_time']);
        $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
        $dateTime->setTimezone(new DateTimeZone($timezone));
        $created_time = $dateTime->format('Y-m-d H:i:s');

        $created_time = strtotime($created_time);
        $time1 = date('H:i:s', $created_time);


        $date1 = date('Y-m-d H:i:s', $ad['sessionendtime']);
        $dateTime1 = new DateTime($date1, new DateTimeZone($default_timezone));
        $dateTime1->setTimezone(new DateTimeZone($timezone));
        $created_time1 = $dateTime1->format('Y-m-d H:i:s');

        $created_time1 = strtotime($created_time1);
        $time2 = date('H:i:s', $created_time1);
        $ts = 'From ' . $time1 . ' to ' . $time2;
    } else {
        $default_timezone = date_default_timezone_get();
        $date = date('Y-m-d H:i:s', $ad['created_time']);
        $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
        $dateTime->setTimezone(new DateTimeZone($timezone));
        $created_time = $dateTime->format('Y-m-d H:i:s');

        $created_time = strtotime($created_time);
        $time1 = date('H:i:s', $created_time);

        $timeend = '+ ' . $ad['shopping_timer'] . ' minutes';
        $time2 = date("H:i:s", strtotime($timeend, $created_time));
        $int_TR = $ad['shopping_timer'] - intval(((time() - $ad['created_time']) / 60));

        if ($int_TR > 0) {
            $ts = 'From ' . $time1 . ' to Ongoing';
        } else {
            $ts = 'From ' . $time1 . ' to ' . $time2;
        }
    }

    $a[] = $ts;
    $a[] = date('m/d/Y', $created_time);
    $a[] = utf8_decode($ad['applicant']);
    $a[] = utf8_decode($ad['email']);
    $a[] = utf8_decode($ad['country']);
    $a[] = utf8_decode($ad['telephone']);
    fputcsv($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    fputcsv($fp, $a); 
    $srno++;
}
fclose($fp);
?>
