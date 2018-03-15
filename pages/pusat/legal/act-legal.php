<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['nik-legal']) && isset($_SESSION['nik'])){
    $nik = $_SESSION['nik'];
    $cabang = $_POST['selectCabang'];
    $nikLegal = $_POST['nik-legal'];
    $nama = $_POST['nama-legal'];
    $hakAkses = $_POST['selectHakAkses'];
    $aktif = 'Y';
    $password = 'agris123';
    $passMd5 = md5($password);
    $createAt = date("Y-m-d H:i:s");

    // cek nik sudah terdaftar atau belum
    $cekNik = mysqli_query($Open, "select * from user where nik ='$nikLegal'");
    if($row = mysqli_num_rows($cekNik)  > 0){
        $status = 'nik';
    }else {
        $sql = mysqli_query($Open, "insert into user VALUES (''
                                                                    ,'".$nikLegal."'
                                                                    , '".$nama."'
                                                                    ,'".$passMd5."'
                                                                    ,'".$cabang."'
                                                                    ,'".$hakAkses."'
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