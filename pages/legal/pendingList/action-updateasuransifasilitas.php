<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputFasUpdate'])&& isset($_SESSION['nik'])){
    $idInputAsuransi = $_POST['idInputFasUpdate'];
    $nik = $_SESSION['nik'];

    $jenAs = $_POST['selectAsuransiFasUpdate'];
    $AsLain = $_POST['asuransiLainnyaFasUpdate'];
    $objAs = $_POST['selectObjekAsuransiFasUpdate'];
    $objLain = $_POST['objekLainnyaFasUpdate'];
    $alamat = $_POST['alamatLokasiAsuransiFasUpdate'];
    $nilaiPertanggungan = $_POST['nilaiPertanggunganFasUpdate'];
    $namaAs = $_POST['namaAsuransiFasUpdate'];
    $polis = $_POST['polisFasUpdate'];
    $startDate = $_POST['tglMulaiAsuransiFasUpdate'];
    $endDate = $_POST['tglBerakhirAsuransiFasUpdate'];

    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputasuransifasilitas set 
                                          jenis_asuransi = '$jenAs'
                                         ,asuransi_lain = '$AsLain'
                                         ,objek_asuransi = '$objAs'
                                         ,objek_lain = '$objLain'
                                         ,alamat = '$alamat'
                                         ,nilai_pertanggungan = '$nilaiPertanggungan'
                                         ,nama_asuransi = '$namaAs'
                                         ,polis = '$polis'
                                         ,start_date = '$startDate' 
                                         ,end_date = '$endDate'
                                         ,update_at = '$updateAt'              
                                      where id_asuransi = '$idInputAsuransi' ");


    if($sql){
        $status = 'ok';
        // insert into histinpuasuransifasilitas
        $sqlHist = mysqli_query($Open, "insert into histinputasuransifasilitas VALUES (''
                                                                                    ,'".$idInputAsuransi."'
                                                                                    ,'".$jenAs."'
                                                                                    ,'".$AsLain."'
                                                                                    ,'".$objAs."'
                                                                                    ,'".$objLain."'
                                                                                    ,'".$alamat."'
                                                                                    ,'".$nilaiPertanggungan."'
                                                                                    ,'".$namaAs."'
                                                                                    ,'".$polis."'
                                                                                    ,'".$startDate."'
                                                                                    ,'".$endDate."'
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