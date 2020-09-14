<?php 

require ('db.php');
$rest_json = file_get_contents("php://input");
$headers = getallheaders();
var_dump($headers);
//echo $headers['authorization'];
//echo "working";
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
    //var_dump($url_components['path']);
    $path = explode("/", $url_components['path']);
    //var_dump($path);
//     foreach (getallheaders() as $name => $value) { 
//     echo "$name: $value <br>"; 
// } 


        $query = "SELECT c.userid, c.event_name, c.event_date, c.event_start_time, c.event_end_time, c.event_id FROM calender_events c LEFT JOIN users u ON c.userid = u.userid WHERE u.userid='$logged_in_userid' ORDER BY c.event_date ";
        $result = $connect->query($query);
echo $query;
$feedData = mysqli_fetch_all($result,MYSQLI_ASSOC);
$feedData=json_encode($feedData);


echo ($feedData);

    
//echo $query;

}



?>