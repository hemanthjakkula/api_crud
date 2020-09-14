<?php


$connect = mysqli_connect("sql12.freesqldatabase.com", "sql12365554", "icz2ee5brJ", "sql12365554" );
if ($connect->connect_error) {
	die("Connection Failed: " .$connect->connect_error);
}
