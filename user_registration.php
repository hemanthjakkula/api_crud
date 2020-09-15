<?php
require('db.php');
echo ($_POST['username']);
$rest_json = file_get_contents("php://input");
var_dump($rest_json);
$jsonData = json_decode($rest_json, true);
if (isset($jsonData['username']) && isset($jsonData['email']) && isset($jsonData['password'])) {

    $username = $jsonData['username'];
    $email = $jsonData['email'];
    $password = $jsonData['password'];

    if (isset($email)) {
        $query = "SELECT email FROM users WHERE email = '$email'  ";
        $result = $connect->query($query);
        $resultrow = mysqli_num_rows($result);
        $feedData = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //var_dump($feedData);
        if ($resultrow >= 1) {
            echo '{"email":"AlreadyExists"}';
        } else {
            //we can also create a random string with username, random chars
            function RandomStringGenerator($n)
            {

                $generated_string = "";
                $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                $len = strlen($domain);
                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, $len - 1);
                    $generated_string = $generated_string . $domain[$index];
                }
                return $generated_string;
            }
            $token_length = 15;
            //generating the token
            $token = RandomStringGenerator($token_length);
            //saving into the DB
            $query = "INSERT INTO users (name, email, password, token) VALUES ('$username', '$email', '$password', '$token')";

            $connect->query($query);
            echo '{"email":"success"}';
        }
    }
}
