<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCaraPenarikanUpdate'])&& isset($_SESSION['nik'])){
    $idPenarikan = $_POST['idCaraPenarikanUpdate'];
    $nik = $_SESSION['nik'];

    $penarikan = $_POST['caraPenarikanUpdate'];
    $updateAt = date("Y-m-d H:i:s");
    $sql = mysqli_query($Open, "update tb_inputcarapenarikan set penarikan = '".$penarikan."', nik = '".$nik."', update_at = '".$updateAt."' where id_carapenarikan = '".$idPenarikan."' ");

    if($sql){
        $status = 'ok';
        // insert into histinpucarapenarikan
        $sqlHist = mysqli_query($Open, "insert into histinputcarapenarikan VALUES (''
                                                                                          ,'".$idPenarikan."'
                                                                                          ,'".$penarikan."'
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