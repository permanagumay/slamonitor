<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputFasUpdate']) && isset($_SESSION['nik'])){
    $idInputFas = $_POST['idInputFasUpdate'];
    $nik = $_SESSION['nik'];

    $agunan = $_POST['selectAgunanFasUpdate'];
    $tipPlaf = $_POST['tipePlafondUpdate'];
    $tipLain = $_POST['tipeLainnyaUpdate'];
    $jenFas = $_POST['selectFasilitasUpdate'];
    $codFas = $_POST['codeFasilitasUpdate'];
    $seqFas = $_POST['SeqFasilitasUpdate'];
    $plafFas = $_POST['plafondFasUpdate'];
    $updateAt = date("Y-m-d H:i:s");
    $seqFasCode = $codFas.$seqFas;

    $sql = mysqli_query($Open, "update tb_inputfasilitas set id_agunan = '".$agunan."'
                                                                   ,jenis_fasilitas = '".$jenFas."'
                                                                   ,fascode = '".$seqFasCode."'
                                                                   ,plafond = '".$plafFas."'
                                                                   ,id_tipkredit = '".$tipPlaf."'
                                                                   ,tipkreditlain = '".$tipLain."'                                                                   
                                                                   ,update_at = '".$updateAt."' where id_inputfasilitas = '".$idInputFas."'");

    if($sql){
        $status = 'ok';
        // insert into histinputfasilitas
        $sqlHist = mysqli_query($Open, "insert into histinputfasilitas VALUES (''
                                                                                      ,'".$idInputFas."'
                                                                                      ,'".$agunan."'
                                                                                      ,'".$jenFas."'
                                                                                      ,'".$seqFasCode."'
                                                                                      ,'".$plafFas."'
                                                                                      ,'".$tipPlaf."'
                                                                                      ,'".$tipLain."'
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