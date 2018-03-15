<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['nik-marketing']) && isset($_SESSION['nik'])){
    $nikMarketing = $_POST['nik-marketing'];
    $nik = $_SESSION['nik'];
    $cabang = $_POST['selectCabang'];
    $nama = $_POST['nama-marketing'];
    $codeHo = $_POST['code-ho'];
    $aktif = 'Y';
    $createAt = date("Y-m-d H:i:s");

    // cek nik sudah terdaftar atau belum
    $cekNik = mysqli_query($Open, "select * from master_marketing where nik_marketing ='$nikMarketing'");
    if($row = mysqli_num_rows($cekNik)  > 0){
        $status = 'nik';
    }else {
        $sql = mysqli_query($Open, "insert into master_marketing values (''
                                                                                ,'".$nikMarketing."'
                                                                                ,'".$nama."'
                                                                                ,'".$codeHo."'
                                                                                ,'".$cabang."'
                                                                                ,'".$aktif."'
                                                                                ,'".$nik."'
                                                                                ,'".$createAt."'
                                                                                ,'')");
        if($sql){
            $status = 'ok';
        }else {
            $status = 'sql';
        }

    }
    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}