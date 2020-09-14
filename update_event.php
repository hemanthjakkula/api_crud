<?php
require ('db.php');
$rest_json = file_get_contents("php://input");
$headers = getallheaders();
//echo $headers['authorization'];
if (isset($headers['authorization'])) {
    $token = $headers['authorization'];
    $query_for_userid = "SELECT userid FROM users WHERE token = '$token' ";
    $result = $connect->query($query_for_userid);
    $feedData = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //echo($feedData[0]['userid']);
    $logged_in_userid = $feedData[0]['userid'];

$jsonData = json_decode($rest_json, true);
//var_dump($jsonData);


if ( isset($jsonData['event_name']) && isset($jsonData['event_date']) && isset($jsonData['event_start_time']) && isset($jsonData['event_end_time'])) {

	$query = "UPDATE calender_events set event_name='$jsonData[event_name]', event_date='$jsonData[event_date]', event_start_time = '$jsonData[event_start_time]', event_end_time = '$jsonData[event_end_time]' WHERE event_id = '$jsonData[event_id]' AND userid='$logged_in_userid' ";

 	$connect->query($query);

 	$query1 = "SELECT event_id,event_name, event_date,event_start_time, event_end_time FROM calender_events WHERE event_id = '$jsonData[event_id]' AND userid = '$logged_in_userid' ";

	$result = $connect->query($query1);
 	
 	$feedData = mysqli_fetch_all($result,MYSQLI_ASSOC);
$feedData=json_encode($feedData[0]);


echo ($feedData);
}

}
?>