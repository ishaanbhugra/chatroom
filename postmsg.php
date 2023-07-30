<?php

//connecting to the database
include "db_connect.php";


$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];


$sql= "INSERT INTO `msgs` (`msg`, `room`, `ip`, `time`) VALUES ('$msg', '$room', '$ip', CURRENT_TIMESTAMP());";

mysqli_query($con,$sql);
mysqli_close($con);
?>