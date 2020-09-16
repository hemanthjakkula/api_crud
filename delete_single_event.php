<?php
require('db.php');
$rest_json = file_get_contents("php://input");
$headers = getallheaders();

if (isset($headers['Authorization'])) {
     $token = $headers['Authorization'];
     $query_for_userid = "SELECT userid FROM users WHERE token = '$token' ";
     $result = $connect->query($query_for_userid);
     $feedData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
     $logged_in_userid = $feedData[0]['userid'];

     if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
          $url = "https://";
     else
          $url = "http://";
     // Append the host(domain name, ip) to the URL.   
     $url .= $_SERVER['HTTP_HOST'];

     // Append the requested resource location to the URL   
     $url .= $_SERVER['REQUEST_URI'];

     
     $url_components = parse_url($url);
     parse_str($url_components['query'], $params);
     
     $jsonData = json_decode($params["filter"], true);
     $events_ids = $jsonData['id'];
     echo $event_ids;

     if (isset($event_ids)) {

        $query = "DELETE FROM calender_events WHERE userid = '$logged_in_userid' AND event_id IN ('" . $event_ids . "') ";
        $connect->query($query);

        $query1 = "SELECT c.userid, c.event_name, c.event_date, c.event_start_time, c.event_end_time, c.event_id FROM calender_events c LEFT JOIN users u ON c.userid = u.userid WHERE u.userid='$logged_in_userid' ORDER BY c.event_date ";
            
        $result = $connect->query($query1);
    
        $feedData1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $feedData1 = json_encode($feedData1);

        echo ($feedData1);


     }
}
