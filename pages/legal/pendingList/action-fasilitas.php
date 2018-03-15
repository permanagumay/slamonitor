<?php

include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrmFas']) && isset($_SESSION['nik'])){

    $idCrm = $_POST['idCrmFas'];
    $nik = $_SESSION['nik'];

    $jamFas = strip_tags($_POST['selectAgunanFas']);
    $selFas = strip_tags($_POST['selectFasilitas']);
    $codeFas= strip_tags($_POST['codeFasilitas']);
    $seqFas = strip_tags($_POST['SeqFasilitas']);
    $plafFas = strip_tags($_POST['plafondFas']);
    $tipeFas = strip_tags($_POST['tipePlafond']);
    $tipeLain = strip_tags($_POST['tipeLainnya']);
    $createAt = date("Y-m-d H:i:s");

    $codeFasSeq = $codeFas.$seqFas;

    $sql  = mysqli_query($Open, "insert into tb_inputfasilitas VALUES (''
                                                                              ,'".$jamFas."'
                                                                              ,'".$selFas."'
                                                                              ,'".$codeFasSeq."'
                                                                              ,'".$plafFas."'
                                                                              ,'".$tipeFas."'
                                                                              ,'".$tipeLain."'
                                                                              ,'".$nik."'
                                                                              ,'".$createAt."'
                                                                              ,'')");
    if($sql){
        $sqlGetId = mysqli_query($Open, "select id_inputfasilitas from tb_inputfasilitas where id_agunan = '".$jamFas."' and jenis_fasilitas = '".$selFas."' and fascode = '".$codeFasSeq."' and plafond = '".$plafFas."'   ");
        $resultGetId = mysqli_fetch_array($sqlGetId);

        $number = count($_POST["caraPenarikan"]);
        if($number > 0){
            for($i = 0; $i < $number; $i++){
                if(trim($_POST["caraPenarikan"][$i] != '')){
                    $penarikan = $_POST["caraPenarikan"][$i];
                    $sqlPenarikan = mysqli_query($Open, "insert into tb_inputcarapenarikan values('','".$resultGetId[0]."','".$penarikan."','".$nik."' ,'".$createAt."','')");

                }
            }
            
            $status = 'ok';
            echo $status;die;
        }

        $status = 'ok';
    }else {
        $status = 'sql';
    }
    echo $status;die;


}else {
    $status = 'error';
    echo $status;die;
}



