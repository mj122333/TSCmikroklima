<?php
echo 
//"<iframe src='https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Europe%2FVienna&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0&mode=DAY&dates=". date('Ymd', strtotime($Date. ' +0 days'))."/". date('Ymd', strtotime($Date. ' + 1 days'))."&src=Y19jbGFzc3Jvb202ZjIzMTM3ZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23D50000' onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));' style='height:100%;width:100%;border:none;overflow:hidden;'></iframe>";
//onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:200px;width:100%;border:none;overflow:hidden;"
//"<iframe src='https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Europe%2FVienna&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=1&showTz=0&mode=DAY&timeMin=2023-01-26T00:00:00&timeMax=2023-01-28T00:00:00&src=Y19jbGFzc3Jvb202ZjIzMTM3ZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23D50000' onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));' style='height:100%;width:100%;border:none;overflow:hidden;'></iframe>";


//$url="https://calendar.google.com/calendar/embed?wkst=1&bgcolor=%23ffffff&ctz=Europe%2FBelgrade&mode=AGENDA&src=Y19jbGFzc3Jvb202ZjIzMTM3ZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t";
$date = '2023-01-01';
$start_time ='00:00';
$end_time ='23:59';
$date_end = '2023-05-01';
$access_token='AIzaSyBqizv1QAmywsUAYJVy_kCtMkfYW5ii6MM';
$calendar_id="c_classroom6f23137d@group.calendar.google.com";
$start = array(
        "dateTime" => $date . "T" . $start_time . ":00",
        "timeZone" => "Europe/Berlin"
    );

    $end = array(
        "dateTime" => $date_end . "T" . $end_time . ":00",
        "timeZone" => "Europe/Berlin"
    );

    $headerarray = array(
        'Content-type: application/json',
        'Authorization: Bearer ' . $access_token,
        'X-JavaScript-User-Agent: Google APIs Explorer'
    );

    $post_data = array(
        "start"       => $start,
        "end"         => $end,
        "summary"     => $title,
        "description" => $description,
        "key"         => $api_key
    );

    $post_data = json_encode($post_data);

    $url = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerarray);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $response = json_decode($response);
    print_r($response);
?>