<?php
require_once "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idAgunan']) && isset($_SESSION['nik'])){
    $idAgunan = $_POST['idAgunan'];
    $nik = $_SESSION['nik'];

    $jenisAgunan = $_POST['selectUpdateAgunan'];
    $alamat = $_POST['updateAlamatLokasi'];
    $certificate = $_POST['updateNo_sertificate'];
    $HGB = $_POST['updateDuedate'];
    $namaPemilik = $_POST['updateNama_pemilik'];
    $jenisPengikatan = $_POST['selectUpdatePengikatan'];
    $noAkta = $_POST['updateNomorAkta'];
    $penjaminanNilai = $_POST['updateNilaiJaminan'];
    $tglPengurusan = $_POST['updateAgunanTglPengurusan'];
    $tglTarget = $_POST['updateAgunanTglTarget'];
    $tglKhasanah = strip_tags($_POST['updateKhasanahDate']);
    $updateAt = date("Y-m-d H:i:s");

    if($jenisAgunan == 19){
        $agunanLain = $_POST['updateAgunanLainnya'];
    }else {
        $agunanLain = '';
    }

    if($jenisPengikatan == 7){
        $pengikatanLain = $_POST['updatePengikatanLainnya'];
    }else {
        $pengikatanLain = '';
    }
	
	if($HGB == ''){
        $newTglHgb = '1111/11/11';
    }else {
        $newTglHgb = $HGB;
    }
	
	if($tglKhasanah == '' || $tglKhasanah == '0000/00/00'){
        $khasanahDate = '';
    }else {
        $khasanahDate = $tglKhasanah;
    }


    $sql = mysqli_query($Open, "update tb_inputjaminan set jaminan = '$jenisAgunan'
                                                                ,jaminan_lain = '$agunanLain'
                                                                ,duedate_hgb = '$newTglHgb'
                                                                ,alamat = '$alamat'
                                                                ,no_certificate = '$certificate'
                                                                ,nama_pemilik = '$namaPemilik'
                                                                ,pengikatan = '$jenisPengikatan'
                                                                ,pengikatan_lain = '$pengikatanLain'
                                                                ,nilai_penjaminan = '$penjaminanNilai'
                                                                ,no_akta = '$noAkta'
                                                                ,tgl_pengurusan = '$tglPengurusan'
                                                                ,tgl_target = '$tglTarget'
                                                                ,tgl_khasanah = '$khasanahDate'
                                                                ,update_at = '$updateAt' where id_agunan = '$idAgunan'");
    if($sql){
        $status = 'ok';
        // insert to histinputjaminan
        $sqlHist = mysqli_query($Open, "insert into histinputjaminan values(''
                                                                                  ,'".$idAgunan."'
                                                                                  ,'".$jenisAgunan."'
                                                                                  ,'".$agunanLain."'
                                                                                  ,'".$newTglHgb."'
                                                                                  ,'".$alamat."'
                                                                                  ,'".$certificate."'
                                                                                  ,'".$namaPemilik."'
                                                                                  ,'".$jenisPengikatan."'
                                                                                  ,'".$pengikatanLain."'
                                                                                  ,'".$penjaminanNilai."'
                                                                                  ,'".$noAkta."'
                                                                                  ,'".$tglPengurusan."'
                                                                                  ,'".$tglTarget."'
                                                                                  ,''
                                                                                  ,'".$khasanahDate."'
                                                                                  ,''
                                                                                  ,'".$nik."'
                                                                                  ,'".$updateAt."'
                                                                                  ,'' )");
    }else {
        $status = 'sql';
    }

    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}