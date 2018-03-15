<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputFas']) && isset($_SESSION['nik'])){
    $idInputFas = $_POST['idInputFas'];
    $nik = $_SESSION['nik'];
    $caraPenarikan = $_POST['caraPenarikanTambah'];
    $create_at = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputcarapenarikan values ('','".$idInputFas."', '".$caraPenarikan."', '".$nik."', '".$create_at."','')");

    if($sql){
        $status = 'ok';
    }else {
        $status = 'sql';
    }

    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}