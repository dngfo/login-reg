<?php
require_once 'member/config.php';
$s = new pro;
if($s->chklog()){
header("location: member/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
</head>
<body>
  <a href="register.php">register</a>
</body>
</html>