<?php

require('db.php');
$rest_json = file_get_contents("php://input");
$jsonData = json_decode($rest_json, true);

$email = $jsonData["email"];
$password = $jsonData["password"];

if (isset($email) && isset($password)) {
	$query = "SELECT email, password, token FROM users WHERE email = '$email' AND password = '$password' ";
	$result = $connect->query($query);
	$resultrow = mysqli_num_rows($result);
	$feedData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if ($resultrow == 1) {
		echo json_encode($feedData[0]["token"]);
		
	} else {
		echo '{"token": "Invalid"}';

	}
}
