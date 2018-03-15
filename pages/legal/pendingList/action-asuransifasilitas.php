<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputFas']) && isset($_SESSION['nik'])){
    $idInputFas = $_POST['idInputFas'];
    $nik = $_SESSION['nik'];

    $jenisAsu = $_POST['selectAsuransiFas'];
    $jenisAsuLain =  $_POST['asuransiLainnyaFas'];
    $objAsu = $_POST['selectObjekAsuransiFas'];
    $objAsuLain = $_POST['objekLainnyaFas'];
    $alamat = $_POST['alamatLokasiAsuransiFas'];
    $nilaiPertanggungan = $_POST['nilaiPertanggunganFas'];
    $namaAsu = $_POST['namaAsuransiFas'];
    $polisAsu = $_POST['polisFas'];
    $startDate = $_POST['tglMulaiAsuransiFas'];
    $endDate = $_POST['tglBerakhirAsuransiFas'];
    $createAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputasuransifasilitas VALUES (''
                                                                                    ,'".$idInputFas."'
                                                                                    ,'".$jenisAsu."'
                                                                                    ,'".$jenisAsuLain."'
                                                                                    ,'".$objAsu."'
                                                                                    ,'".$objAsuLain."'
                                                                                    ,'".$alamat."'
                                                                                    ,'".$nilaiPertanggungan."'
                                                                                    ,'".$namaAsu."'
                                                                                    ,'".$polisAsu."'
                                                                                    ,'".$startDate."'
                                                                                    ,'".$endDate."'
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

