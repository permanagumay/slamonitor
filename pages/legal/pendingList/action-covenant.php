<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrm']) && isset($_SESSION['nik'])){
    $idCrm = strip_tags($_POST['idCrm']);
    $nik = $_SESSION['nik'];

    $selectCovenant = strip_tags($_POST['selectCovenant']);
    $covenantLain = strip_tags($_POST['covenantLainnya']);
    $tglMulai = strip_tags($_POST['TglMulaiCovenant']);
    $tglTarget = strip_tags($_POST['TglTargetCovenant']);
    $statusProgress = 3;
    $create_at = date("Y-m-d H:i:s");


    $sql = mysqli_query($Open, "insert into tb_inputcovenant VALUES (''
                                                                            ,'".$idCrm."'
                                                                            ,'".$selectCovenant."'
                                                                            ,'".$covenantLain."'
                                                                            ,'".$tglMulai."'
                                                                            ,'".$tglTarget."'
                                                                            ,''
                                                                            ,'".$statusProgress."'
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