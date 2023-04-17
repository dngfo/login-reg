<?php
session_start();
//mengecek request method
if (!$_SERVER["REQUEST_METHOD"] === "POST") {
    header("HTTP/1.1 401 Unauthorized");
    die('<p style="text-align:center;color:red;font-size:20px;">tidak boleh mengakses</p>');
}else if(isset($_POST["reg"]) || isset($_POST["log"])) {
    header("HTTP/1.1 200 OK");
}
class pro{
    protected $c;
    public $nama, $pass, $q;
    public function __construct() {
        $this->mon('mongodb://username:password@domain:port');
    }

     /** 
    * fungsi yang akan mengaktifkan mongodb
    * @param string $con url nama dan password admin database mongodb 
    */
    public function mon($con) {
        try {
            $this->c = new MongoDB\Driver\Manager($con);
        } catch (Exception $e) {
            echo "error cuy";
        }
    }

    /** 
    * fungsi yang akan memasukan user dan password ke database mongodb
    * @param string $nama nama user yang akan di masukan 
    * @param string $pwd password yang akan di masukan
    */
    public function reg($nama, $pwd) {
        if (isset($_POST["reg"])) {
            // celah cihuy
            $this->chkname($nama);
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->insert(['nama' => $nama, 'pass' => $pwd]);
            $this->c->executeBulkWrite("database.collection", $bulk);
            header("location: ../login.php");
        }
    }

    /** 
    * fungsi yang akan mengecek user dan password di database mongodb
    * @param string $nama nama yang akan di cek
    * @param string $pass password yang akan di cek
    */
    public function log($nama, $pass) {
        if (isset($_POST["log"])) {
            $filter = ["nama" => $nama, "pass" => $pass];
            $options = [];
            $this->q = new MongoDB\Driver\Query($filter, $options);
            $cur = $this->c->executeQuery("database.collection", $this->q);
            }
            //memecah nama dan password
            $array = json_decode(json_encode($cur), true);
            foreach ($cur as $d) {
            $array[0] = $d->nama;
            $array[1] = $d->pass;
            }
            if ($array[0] == $nama and $array[1] == $pass) {
                if (!empty($_POST["remember"])) {
                    $per = $array[0];
                    $enc = openssl_encrypt($per, "aes-256-cbc", "p");
                    setcookie("nama", $enc, strtotime("+30days"), "/member", "", true, true);
                    // setcookie("log", $nama, time()+ (10 * 365 * 24 * 60 * 60);
                    setcookie("in", $pass, strtotime("+30 days"), "/member", "", true, true);
                    header("location:member/index.php");
                }else {
                    // setcookie("log", $nama, strtotime("+7 days"));
                    $per = $array[0];
                    $enc = openssl_encrypt($per, "aes-256-cbc-hmac-sha256", "p");
                    setcookie("nama", $enc, strtotime("+7 days"), "/member", "", true, true);
                    setcookie("in", $pass, strtotime("+7 days"), "/member", "", true, true);
                    header("location:member/index.php");
                }
            } else {
                echo"salah";
            }
    }
    public function chklog(){
        if($_COOKIE["in"]) {
            return true;
        }else {
            return false;
        }
    }
     /** 
    * fungsi yang akan mengeluarkan atau menghancurkan sesi dan cookie
    */
    public function remove(){
        session_destroy();
        unset($_SESSION["logged"]);
        unset($_SESSION["log"]);
        unset($_SESSION["in"]);
        setcookie('log', time() - 120);
        setcookie('in', time() - 120);
        return true;
    }
     /** 
    * fungsi yang akan mengecek nama dalam database
    * @param string $nama nama yang akan di cek
    */
    public function chkname($nama){
        $filter = ["nama" => $nama];
        $this->q = new MongoDB\Driver\Query($filter);
        $cur = $this->c->executeQuery("member.user", $this->q);
        $has = current($cur->toArray());
        if ($has) {
            return true;
        }else {
            return false;
        }
    }
     /** 
    * fungsi untuk menginformasikan bahwa directory ini khusus
    */
    public static function forbidden() {
        header('HTTP/1.1 403 Forbidden');
        header('Location: index.php');
        die();
    }
}