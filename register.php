<?php
require_once("member/config.php");
session_start();
$let = new pro();
if (!empty($_POST['nama'] && $_POST['pass'])) {
    $nam = htmlspecialchars($_POST["nama"]);
    $p = htmlspecialchars($_POST["pass"]);
    $ad = $let->chkname($nam);
    if (strlen($p) < 8 || !preg_match('/[A-Z]/', $p) || !preg_match('/[a-z]/', $p)) {
        echo "Password harus memiliki setidaknya 8 karakter dan mengandung setidaknya satu huruf besar dan satu huruf kecil";
        exit;
    }else {
        $pwd = hash('sha512',$p);
    }
    if ($ad) {
        echo 'nama sama';
    }else {
        $let->reg($nam, $pwd);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<body>
    <form action="" method="post">
        <label for="nama">nama:</label>
        <input type="text" name="nama" id="nama" placeholder="nama" required><br>
        <label for="pass">passwut:</label>
        <input type="password" name="pass" id="pass" placeholder="passwut" required><br>
        <label for="cpass">konfirmasi pass</label>
        <input type="password" name="cpass" id="cpass" onblur="chk()" placeholder="konfirmasi" required><br>
        <input type="checkbox" id="show-password" onchange="togglePasswordVisibility()">
        <label for="show-password">Show password</label>
        <div id="error"></div>
        <button type="submit" name="reg">REGISTER</button>
    </form>
    <script src="js/script.js"></script>
</body>
</html>