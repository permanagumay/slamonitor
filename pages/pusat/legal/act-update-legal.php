<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idUser']) && isset($_SESSION['nik'])){
    $idUser = $_POST['idUser'];
    $nik = $_SESSION['nikUpdate'];
    $cabang = $_POST['selectCabangUpdate'];
    $nikLegal = $_POST['nik-legalUpdate'];
    $nama = $_POST['nama-legalUpdate'];
    $hakAkses = $_POST['selectHakAksesUpdate'];
    $statusAktif = $_POST['status-aktif'];

    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update user set 
                                        nama = '".$nama."'
                                        ,id_cabang = '".$cabang."'
                                        ,nik = '".$nikLegal."'
                                        ,hak_akses = '".$hakAkses."'
                                        ,aktif = '".$statusAktif."'
                                        ,update_at = '".$updateAt."'
                                        ,nik_input = '".$nik."'
                                      where id_user = '$idUser'");

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