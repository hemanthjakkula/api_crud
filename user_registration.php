<?php
require('db.php');
echo "hiiii";
//print_r($_POST);

$rest_json = file_get_contents("php://input");
var_dump($rest_json);
//$jsonData = json_decode($rest_json, true);
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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
