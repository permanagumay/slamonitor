<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrm'])&& isset($_SESSION['nik'])){
    $idCrm = $_POST['idCrm'];
    $nik = $_SESSION['nik'];

    $nopk = $_POST['no_pk'];
    $tglPengurusan = $_POST['tglPengurusan'];
    $tglTarget = $_POST['tglTarget'];
    $tglPemenuhan = $_POST['tglPemenuhan'];
    $tglKhasanah = $_POST['tglKhasanah'];
    $status = $_POST['status-progress'];
    $keterangan = $_POST['keterangan-sign'];

    $createAt = date("Y-m-d H:i:s");

    // cek
    $sqlCek = mysqli_query($Open, "select * from tb_inputsignpk where id_crm = '$idCrm'");
    $rows = mysqli_num_rows($sqlCek);
    if($rows > 0){
        $status = 'ada';
    }else{
        if($status == 1){
            $sql = mysqli_query($Open, "insert into tb_inputsignpk VALUES (''
                                                                        ,'".$idCrm."'
                                                                        ,'".$nopk."'
                                                                        ,'".$tglPengurusan."'
                                                                        ,'".$tglTarget."'
                                                                        ,'".$tglPemenuhan."'
                                                                        ,'".$tglKhasanah."'
                                                                        ,'".$status."'
                                                                        ,'".$keterangan."'
                                                                        ,'".$nik."'
                                                                        ,'".$createAt."'
                                                                        ,'')");

        }else {
            $sql = mysqli_query($Open, "insert into tb_inputsignpk VALUES (''
                                                                        ,'".$idCrm."'
                                                                        ,'".$nopk."'
                                                                        ,'".$tglPengurusan."'
                                                                        ,'".$tglTarget."'
                                                                        ,''
                                                                        ,'".$tglKhasanah."'
                                                                        ,'".$status."'
                                                                        ,'".$keterangan."'
                                                                        ,'".$nik."'
                                                                        ,'".$createAt."'
                                                                        ,'')");
        }


        if($sql){
            $status = 'ok';
        }else {
            $status = 'sql';
        }
    }
    echo $status;die;

}else {
    $status = 'Error';
    echo $status;die;
}