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

 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    //echo ($url). "\n"; 
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    //var_dump($params["filter"]);
    $jsonData = json_decode($params["filter"], true);
    //var_dump($params);
    //to get userid value
    //print_r( $jsonData['id']);
    //echo gettype($jsonData['id']);
    $headers = getallheaders();
    //echo $headers['authorization'];
    if (isset($jsonData['id'])) {

    	$event_ids= implode("','",$jsonData['id']);

    }


       //echo $event_ids;

if (isset($event_ids)) {

     $query = "DELETE FROM calender_events WHERE userid = '$logged_in_userid' AND event_id IN ('".$event_ids."') ";
     $connect->query($query);

     //$query1="SELECT event_id, event_name, event_date, event_start_time, event_end_time FROM calender_events WHERE userid='1' ";
//echo $query;
	 //$result = $connect->query($query1);

	 //$feedData = mysqli_fetch_all($result,MYSQLI_ASSOC);
	 //$feedData=json_encode($feedData);


//echo ($feedData);
	 //echo ($jsonData['id']);
}
}

?>
