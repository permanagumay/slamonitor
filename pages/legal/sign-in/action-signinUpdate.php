<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputSignUpdate']) && isset($_SESSION['nik'])){
    $idInputSiqn = $_POST['idInputSignUpdate'];
    $nik = $_SESSION['nik'];

    $nopk = $_POST['no_pkUpdate'];
    $tglPengurusan = $_POST['tglPengurusanUpdate'];
    $tglTarget = $_POST['tglTargetUpdate'];
    $tglPemenuhan = $_POST['tglPemenuhanUpdate'];
    $tglKhasanah = $_POST['tglKhasanahUpdate'];
    $status = $_POST['status-progressUpdate'];
    $keterangan = $_POST['ket-upsign'];

    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open,"update tb_inputsignpk set
                                        no_pk = '".$nopk."'
                                        ,tgl_pengurusan = '".$tglPengurusan."'
                                        ,tgl_target = '".$tglTarget."'
                                        ,tgl_pemenuhan = '".$tglPemenuhan."'
                                        ,tgl_khasanah = '".$tglKhasanah."'
                                        ,status = '".$status."'
                                        ,keterangan  = '".$keterangan."'
                                        ,update_at = '".$updateAt."'                                    
                                    where id_inputsign = '".$idInputSiqn."'");

    if($sql){
        $status = 'ok';
        // insert to histinputsign
        $sqlHist = mysqli_query($Open, "insert into histinputsignpk values(''
                                                                                  ,'".$idInputSiqn."'
                                                                                  ,'".$nopk."'
                                                                                  ,'".$tglPengurusan."'
                                                                                  ,'".$tglTarget."'
                                                                                  ,'".$tglPemenuhan."'
                                                                                  ,'".$tglKhasanah."'
                                                                                  ,'".$status."'
                                                                                  ,'".$keterangan."'
                                                                                  ,'".$nik."'
                                                                                  ,'".$updateAt."'
                                                                                  ,'')");
    }else {
        $status = 'sql';
    }

    echo $status;die;
}else {
    $status = 'Error';
    echo $status;die;
}