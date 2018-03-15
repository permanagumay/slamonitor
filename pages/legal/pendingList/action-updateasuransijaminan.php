<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputJamUpdate'])&& isset($_SESSION['nik'])){
    $idInputAsuransi = $_POST['idInputJamUpdate'];
    $nik = $_SESSION['nik'];

    $jenAs = $_POST['selectAsuransiJamUpdate'];
    $AsLain = $_POST['asuransiLainnyaJamUpdate'];
    $objAs = $_POST['selectObjekAsuransiJamUpdate'];
    $objLain = $_POST['objekLainnyaJamUpdate'];
    $alamat = $_POST['alamatLokasiAsuransiJamUpdate'];
    $nilaiPertanggungan = $_POST['nilaiPertanggunganJamUpdate'];
    $namaAs = $_POST['namaAsuransiJamUpdate'];
    $polis = $_POST['polisJamUpdate'];
    $startDate = $_POST['tglMulaiAsuransiJamUpdate'];
    $endDate = $_POST['tglBerakhirAsuransiJamUpdate'];

    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputasuransi set
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
        // insert into histinpuasuransi
        $sqlHist = mysqli_query($Open, "insert into histinputasuransi VALUES (''
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