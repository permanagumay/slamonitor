<?php
require_once "../../../assets/koneksi.php";
session_start();
if(isset($_POST['id_crmDev']) && isset($_SESSION['nik'])){
    $idCrm = strip_tags($_POST['id_crmDev']);
    $nik = $_SESSION['nik'];

    $selectDeviasi = strip_tags($_POST['selectDeviasi']);
    $deviasiLain = strip_tags($_POST['deviasiLainnya']);
    $tglMulai = strip_tags($_POST['TglMulaiDeviasi']);
    $tglTarget = strip_tags($_POST['TglTargetDeviasi']);
    $statusProgress = 3;
    $keterangan = strip_tags($_POST['keteranganDeviasi']);

    $create_at = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputdeviasi VALUES (''
                                                                          ,'".$idCrm."'
                                                                          ,'".$selectDeviasi."'
                                                                          ,'".$deviasiLain."'
                                                                          ,'".$tglMulai."'
                                                                          ,'".$tglTarget."'
                                                                          ,''
                                                                          ,'".$statusProgress."'
                                                                          ,'".$keterangan."'
                                                                          ,'".$nik."' 
                                                                          ,'".$create_at."'
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