<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrmPencairan']) && isset($_SESSION['nik'])){
    $idCrm = $_POST['idCrmPencairan'];
    $nik = $_SESSION['nik'];

    $tglPencairan = $_POST['TglPencairan'];
    $createAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputpencairan VALUES (''
                                                                            ,'".$idCrm."'
                                                                            ,'".$tglPencairan."'
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
    $status = 'Error';
    echo $status;die;
}