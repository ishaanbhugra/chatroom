<?php

$room=$_POST['room'];

include "db_connect.php";

$sql="SELECT msg, time, ip FROM msgs WHERE room = '$room'";

$res="";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_assoc($result)){

        $res=$res . '<div class=""container>';
        $res=$res . $row['ip'];
        $res=$res . " says <p>" . $row['msg'];
        $res=$res . '</p> <span class="time-right">' . $row["time"] . '</span> </div>';
    }
}

echo $res;
?>