<?php
require_once "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputUpdateDev'])&& isset($_SESSION['nik'])){
    $idInputDeviasi = strip_tags($_POST['idInputUpdateDev']);
    $nik = $_SESSION['nik'];

    $selectDeviasi = strip_tags($_POST['selectUpdateDeviasi']);
    $tglMulai = strip_tags($_POST['TglMulaiUpdateDeviasi']);
    $tglTarget = strip_tags($_POST['TglTargetUpdateDeviasi']);
    $keterangan = strip_tags($_POST['keteranganUpdateDeviasi']);

    $create_at = date("Y-m-d H:i:s");

    if($selectDeviasi == 6){
        $updateLainnya = strip_tags($_POST['UpdateDeviasiLainnya']);
    }else {
        $updateLainnya = "";
    }

    $sql = mysqli_query($Open, "update tb_inputdeviasi set id_deviasi = '$selectDeviasi'
                                                                 ,deviasi_lain = '$updateLainnya'
                                                                 ,tgl_mulai = '$tglMulai'
                                                                 ,tgl_target = '$tglTarget'
                                                                 ,keterangan = '$keterangan'
                                                                 ,update_at = '$create_at' where id_inputdeviasi = '$idInputDeviasi'  ");
    if($sql){
        $status = 'ok';
        // insert into histinputdeviasi
        $sqlHist = mysqli_query($Open, "insert into histinputdeviasi VALUES (''
                                                                                    ,'".$idInputDeviasi."'
                                                                                    ,'".$selectDeviasi."'
                                                                                    ,'".$updateLainnya."'
                                                                                    ,'".$tglMulai."'
                                                                                    ,'".$tglTarget."'
                                                                                    ,''
                                                                                    ,''
                                                                                    ,'".$keterangan."'
                                                                                    ,'".$nik."'
                                                                                    ,'".$create_at."'
                                                                                    ,'')");
    }else {
        $status = 'sql';
    }


    echo $status;die;

}else {
    $status = 'error';
    echo $status;die;
}