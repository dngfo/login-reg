<?php
require_once("config.php");
$s = new pro();

if($s->chklog()){
       
    echo "Logged in!";
    echo "Welcome !!!";
    

}
else{
    echo "blum login";
    header("Location:../login.php");
}



if(isset($_POST['logout'])){
        
    $var = $s->remove();
    if($var){
        header("location:../login.php");
    }
    else{
        echo "Error!";
    }

}
$enc = $_COOKIE["nama"];
$dec = openssl_decrypt($enc, "aes-256-cbc-hmac-sha256", "p");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>hai</title>
    <!-- <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script> -->
</head>
<body>
    <p><?="hai ". $dec;?></p>
    <form method="post" action="">
        <input type="submit" name="logout" value="logout">
    </form>
</body>
</html>