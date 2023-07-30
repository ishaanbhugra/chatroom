<?php

//get parameters
$roomname = $_GET['roomname'];


//connecting to the database
include "db_connect.php";


//execute sql to check room exists
$sql = "SELECT * FROM `rooms` WHERE `room name` = '$roomname'";


$result = mysqli_query($con,$sql);

if($result){
    //check if room exists
    if(mysqli_num_rows($result)==0){
        $message="this room does not exist";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/project_chatroom";';
        echo '</script>';
    }
}
else{
    echo "Error::".mysqli_error($con);
}


// echo "lets chat now"
?>






<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
    /* max-height: 50px; */
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
    /* max-height: 50px; */
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}


.anyclass{
    height:350px;
    overflow-y:scroll;
}
</style>
</head>
<body>
<div>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
      MYANONYMOUSCHATROOM.COM
    </a>
  </div>
</nav>
</div>
<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="anyclass">
  
</div>





<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">SEND</button>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>


<script type="text/javascript">


//CHECK FOR NEW MSG EVERY 1 SEC
setInterval(runFunction , 1000);
function runFunction(){
    $.post("htcont.php", {room:'<?php echo $roomname?>'}, 
    
    function(data,status){
        document.getElementsByClassName('anyclass')[0].innerHTML=data;
    }
    
    )
}




// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});





    //if user submits the form
    $("#submitmsg").click(function(){
        var clientmsg=$("#usermsg").val();
        $.post("postmsg.php", {text:clientmsg, room:'<?php echo $roomname?>', ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'}),
        function(data,status){
            document.getElementByClassName('anyclass')[0].innerHTML=data;};
            $("#usermsg").val("");
            return false;
        });
</script>
</body>
</html>
