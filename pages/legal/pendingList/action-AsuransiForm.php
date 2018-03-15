<?php

include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idAgunanAsuJam'])&& isset($_SESSION['nik'])){
    $idAgunan = strip_tags($_POST['idAgunanAsuJam']);
    $nik = $_SESSION['nik'];
    $jenisAsuransi = strip_tags($_POST['selectAsuransi']);
    $asuransiLain = strip_tags($_POST['asuransiLainnya']);
    $objekAsuransi = strip_tags($_POST['selectObjekAsuransi']);
    $objekLain = strip_tags($_POST['objekLain']);
    $alamat = strip_tags($_POST['alamatLokasiAsuransi']);
    $nilaiPertanggungan = strip_tags($_POST['nilaiPertanggungan']);
    $namaAsuransi = strip_tags($_POST['namaAsuransi']);
    $noPolis = strip_tags($_POST['polis']);
    $tglMulai = strip_tags($_POST['tglMulaiAsuransi']);
    $tglAkhir = strip_tags($_POST['tglBerakhirAsuransi']);
    $create_at = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "insert into tb_inputasuransi VALUES (''
                                                                            , '".$idAgunan."'
                                                                            , '".$jenisAsuransi."'
                                                                            , '".$asuransiLain."'
                                                                            , '".$objekAsuransi."'
                                                                            , '".$objekLain."'
                                                                            , '".$alamat."'
                                                                            , '".$nilaiPertanggungan."'
                                                                            , '".$namaAsuransi."'
                                                                            , '".$noPolis."'
                                                                            , '".$tglMulai."'
                                                                            , '".$tglAkhir."'
                                                                            , '".$nik."'
                                                                            , '".$create_at."'
                                                                            , '')");

    if($sql){
        $status = 'ok';
    }else {
        $status = 'err';
    }

    echo $status;die;

}else {
    $status = 'error';
    echo $status;die;
}
