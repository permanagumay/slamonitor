<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrmCovNote']) && isset($_SESSION['nik'])){

    $idCrm = $_POST['idCrmCovNote'];
    $nik = $_SESSION['nik'];

    $tglPengikatan = strip_tags($_POST['tglPengikatanCovernote']);
    $selectPengikatan = strip_tags($_POST['selectPengikatanNotaris']);
    $namaNotaris = strip_tags($_POST['namaNotaris']);
    $noCovernote = strip_tags($_POST['noCovernote']);
    $tglCovernote = strip_tags($_POST['tglCovernote']);
    $createAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputcovernote VALUES (''
                                                                            ,'".$idCrm."'
                                                                            ,'".$tglPengikatan."'
                                                                            ,'".$selectPengikatan."'
                                                                            ,'".$namaNotaris."'
                                                                            ,'".$noCovernote."'
                                                                            ,'".$tglCovernote."'
                                                                            ,'".$nik."'
                                                                            ,'".$createAt."'
                                                                            ,'')");


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
