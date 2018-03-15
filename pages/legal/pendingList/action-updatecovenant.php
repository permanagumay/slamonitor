<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputCovenantUpdate']) && isset($_SESSION['nik'])){
    $idInputCovenant = $_POST['idInputCovenantUpdate'];
    $nik = $_SESSION['nik'];

    $idCovenant = $_POST['selectUpdateCovenant'];
    $tglMulai = $_POST['TglMulaiUpdateCovenant'];
    $tglTarget = $_POST['TglTargetUpdateCovenant'];
    $update_at = date("Y-m-d H:i:s");

    if($idCovenant == 5 ){
        $covenantLain = $_POST['updateCovenantLainnya'];
    }else {
        $covenantLain = '';
    }

    $sql = mysqli_query($Open, "update tb_inputcovenant set id_syarat = '$idCovenant'
                                                                  ,syarat_lainnya = '$covenantLain'
                                                                  ,tgl_mulai = '$tglMulai'
                                                                  ,tgl_target = '$tglTarget'
                                                                  ,update_at = '$update_at' where id_input_covenant = '$idInputCovenant'  ");

    if($sql){
        $status = 'ok';
        // insert into histinputcovenant
        $sqlHist = mysqli_query($Open, "insert into histinputcovenant VALUES (''
                                                                                    ,'".$idInputCovenant."'
                                                                                    ,'".$idCovenant."'
                                                                                    ,'".$covenantLain."'
                                                                                    ,'".$tglMulai."'
                                                                                    ,'".$tglTarget."'
                                                                                    ,''
                                                                                    ,''
                                                                                    ,'".$nik."'
                                                                                    ,'".$update_at."'
                                                                                    ,'')");
    }else {
        $status = 'sql';
    }


    echo $status;die;

}else {
    $status = 'error';
    echo $status;die;
}