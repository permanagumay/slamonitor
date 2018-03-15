<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputCovNote'])&& isset($_SESSION['nik'])){
    $idCovNote = $_POST['idInputCovNote'];
    $nik = $_SESSION['nik'];

    $tglPengikatan = strip_tags($_POST['tglPengikatanCovernoteUpdate']);
    $selectPengikatan = strip_tags($_POST['selectPengikatanNotarisUpdate']);
    $namaNotaris = strip_tags($_POST['namaNotarisUpdate']);
    $noCovernote = strip_tags($_POST['noCovernoteUpdate']);
    $tglCovernote = strip_tags($_POST['tglCovernoteUpdate']);
    $updateAt = date("Y-m-d H:i:s");

    if($selectPengikatan == 2){
        $namaNotaris = '';
    }

    $sql = mysqli_query($Open, "update tb_inputcovernote set tgl_pengikatancovernote = '".$tglPengikatan."'
                                                                    ,jenis_pengikatancovernote = '".$selectPengikatan."'
                                                                    ,nama_notaris = '".$namaNotaris."'
                                                                    ,no_covernote = '".$noCovernote."'
                                                                    ,tgl_covernote = '".$tglCovernote."'
                                                                    ,update_at = '".$updateAt."'                                      
                                      where id_inputcovertnote ='".$idCovNote."'");

    if($sql){
        $status = 'ok';
        // insert into histinputcovernote
        $sqlHist = mysqli_query($Open, "insert into histinputcovernote VALUES  (''
                                                                                      ,'".$idCovNote."'
                                                                                      ,'".$tglPengikatan."'
                                                                                      ,'".$selectPengikatan."'
                                                                                      ,'".$namaNotaris."'
                                                                                      ,'".$noCovernote."'
                                                                                      ,'".$tglCovernote."'
                                                                                      ,'".$nik."'
                                                                                      ,'".$updateAt."'
                                                                                      ,'')");
    }else {
        $status = 'sql';
    }

    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}