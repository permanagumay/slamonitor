<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrmDoc']) && isset($_SESSION['nik'])){
    $idCrm = $_POST['idCrmDoc'];
    $nik = $_SESSION['nik'];

    $jenDoc = $_POST['selectDocument'];
    $docLain = $_POST['docLainnya'];
    $tglUrus = $_POST['TglMulaiDoc'];
    $tglTarget = $_POST['TglTargetDoc'];
    $createAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputdoc values(''
                                                                          ,'".$idCrm."'
                                                                          ,'".$jenDoc."'
                                                                          ,'".$docLain."'
                                                                          ,'".$tglUrus."'
                                                                          ,'".$tglTarget."'
                                                                          ,''
                                                                          ,3
                                                                          ,'".$nik."'
                                                                          ,'".$createAt."'
                                                                          ,'')");

    if($sql){
        $status = 'ok';
    }else {
        $status = 'sql';
    }

    echo $status;die;

}else{
    $status = 'error';
    echo $status;die;
}