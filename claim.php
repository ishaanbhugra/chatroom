<?php

//getting value of post parameters
$room = $_POST['room'];


//checking string size
if(strlen($room)>20 or strlen($room)<5){
    $message="please enter a room name between 5 to 20 characters only.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/project_chatroom";';
    echo '</script>';
}


else if(!ctype_alnum($room)){   //if character type is not alpha numeric
    $message="please enter alpha numeric characters only.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/project_chatroom";';
    echo '</script>';
}


else{
    //connect to the database
    include "db_connect.php";
}
echo "working till here";



//check if room already exists


$sql = "SELECT * FROM `rooms` WHERE `room name` = '$room'";

$result = mysqli_query($con,$sql);
if($result){
    if(mysqli_num_rows($result) > 0){
        $message="please choose another name. this room is already taken";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/project_chatroom";';
        echo '</script>';
    }

    else{
        $sql = "INSERT INTO `rooms` (`room name`, `time`) VALUES ('$room', current_timestamp());";

        if(mysqli_query($con,$sql)){

            $message="you can start chatting now. your room is ready.";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/project_chatroom/rooms.php?roomname=' .$room. '";';
            echo '</script>';
        }
    }
}
else{
    echo "ERROR: ".mysqli_error($con);
}    
?>