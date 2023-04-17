<?php
// aji boten saget php
require_once("member/config.php");
require("enc.php");
session_start();
$ay = new pro();
if (!empty($_POST["nama"] && $_POST["pass"])) {
    $nam = htmlspecialchars($_POST["nama"]);
    $p = htmlspecialchars($_POST["pass"]);
    $nam = Security::mongo_db_escape($nam);
    $p = Security::mongo_db_escape($p);
    $pwd = hash('sha512',$p);
    $ay->log($nam, $pwd);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <form action="" method="post">
        <label for="nama">nama</label>
        <input type="text" name="nama" id="nama" required><br>
        <label for="pass">password</label>
        <input type="password" name="pass" id="pass" required><br>
        <input type="checkbox" id="show-password" onchange="togglePasswordVisibility()">
        <label for="show-password">Show password</label>
        <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["log"]) && isset($_COOKIE["in"])) { ?> checked <?php } ?>><label for="remember-me">Remember</label></div>
        <button type="submit" name="log">LOGIN</button>
    </form>
    <script src="js/script.js"></script>
</body>
</html>