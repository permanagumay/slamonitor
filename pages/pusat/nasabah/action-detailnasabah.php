<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['id_crm_detail_nasabah'])&& isset($_SESSION['nik'])){
    $idCrm = $_POST['id_crm_detail_nasabah'];
    $nik = $_SESSION['nik'];

    $statusProgress = $_POST['status-progress'];
    $statusKeterangan = $_POST['status-keterangan'];
    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputcrm  set 
                                      status = '$statusProgress'
                                      ,keterangan = '$statusKeterangan'
                                      ,update_at = '$updateAt'
                                      where id_crm = '$idCrm'");

    if($sql){
        $status = 'ok';
        // insert into histinputcrm
        $sqlHist = mysqli_query($Open, "insert into histinputcrm VALUES (''
                                                                                ,'".$idCrm."'
                                                                                ,''
                                                                                ,''
                                                                                ,''
                                                                                ,''
                                                                                ,''
                                                                                ,''
                                                                                ,'".$nik."'
                                                                                ,'".$statusProgress."'
                                                                                ,'".$statusKeterangan."'
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
