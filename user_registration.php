<?php
require ('db.php');
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];


	//we can also create a random string with username, random chars
	function RandomStringGenerator($n) 
{ 
    
    $generated_string = ""; 
      
    // Create a string with the help of  
    // small letters, capital letters and 
    // digits. 
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
      
    // Find the length of created string 
    $len = strlen($domain); 
      
    // Loop to create random string 
    for ($i = 0; $i < $n; $i++) 
    { 
        // Generate a random index to pick 
        // characters 
        $index = rand(0, $len - 1); 
          
        // Concatenating the character  
        // in resultant string 
        $generated_string = $generated_string . $domain[$index]; 
    } 
      
    // Return the random generated string 
    return $generated_string; 
} 
$token_length = 15;
//generating the token
$token = RandomStringGenerator($token_length);
//saving into the DB
$query = "INSERT INTO users (name, email, password, token) VALUES ('$username', '$email', '$password', '$token')"; 

$connect->query($query);

}

?>