<?php


$connect = mysqli_connect("localhost", "root", "6325", "sarayu_lab_event_management" );
if ($connect->connect_error) {
	die("Connection Failed: " .$connect->connect_error);
}
