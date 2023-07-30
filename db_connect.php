<?php

$server="localhost";
$username="root";
$password="";
$database="chatroom";


//creating database connection
$con=mysqli_connect($server,$username,$password,$database);


//check connection
if(!$con){
    die("Connecion failed due to".mysqli_connect_error());
}
else{
    // echo "Connnection established!!";
}


?>