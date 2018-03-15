<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idUserReset']) && isset($_SESSION['nik'])){
    $idUser = $_POST['idUserReset'];
    $nik = $_SESSION['nik'];
    $updateAt = date("Y-m-d H:i:s");

    $password = md5('agris123');

    $sql = mysqli_query($Open, "update user set password = '".$password."', nik_input = '".$nik."', update_at = '".$updateAt."' where id_user = '".$idUser."'");
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