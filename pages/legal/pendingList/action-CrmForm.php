<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_POST['id_crm']) && isset($_SESSION['nik'])) {
    $idCrm = $_POST['id_crm'];
    $nik = $_SESSION['nik'];

    $agunan = strip_tags($_POST['selectAgunan']);
    $agunanLain = strip_tags($_POST['agunanLainnya']);
    $alamat = strip_tags($_POST['alamatLokasi']);
    $certificate = strip_tags($_POST['no_sertificate']);
    $dueDateHGB = strip_tags($_POST['duedate']);
    $namaPemilik = strip_tags($_POST['nama_pemilik']);
    $pengikatan = strip_tags($_POST['selectPengikatan']);
    $pengikatanLain = strip_tags($_POST['pengikatanLainnya']);
    $akta = strip_tags($_POST['nomorAkta']);
    $nilaiPenjaminan = strip_tags($_POST['nilaiJaminan']);
    $tglPengurusan = strip_tags($_POST['tglPengurusan']);
    $tglTarget = strip_tags($_POST['tglTarget']);
    $tglKhasanah = strip_tags($_POST['tglKhasanah']);
    $statusAgunan = 3;
    $create_at = date("Y-m-d H:i:s");
	
	if($dueDateHGB == ''){
        $newTglHgb = '1111/11/11';
    }else {
        $newTglHgb = $dueDateHGB;
    }

    $sql = mysqli_query($Open,"insert into tb_inputjaminan values (''
                                                                          , '".$idCrm."'
                                                                          , '".$agunan."'
                                                                          , '".$agunanLain."'
                                                                          , '".$newTglHgb."'
                                                                          , '".$alamat."'
                                                                          , '".$certificate."'
                                                                          , '".$namaPemilik."'
                                                                          , '".$pengikatan."'
                                                                          , '".$pengikatanLain."'
                                                                          , '".$nilaiPenjaminan."'
                                                                          , '".$akta."'
                                                                          , '".$tglPengurusan."'
                                                                          , '".$tglTarget."'
                                                                          ,''
                                                                          , '".$tglKhasanah."'
                                                                          , '".$statusAgunan."'
                                                                          , '".$nik."'
                                                                          , '".$create_at."'
                                                                          , '')");
    if($sql){
        $status = 'ok';
    }else {
        $status = 'sql';
    }

    echo $status;die;

}else if(isset($_POST['formSentKPIdCrm'])&& isset($_SESSION['nik'])){

    $idCrm = $_POST['formSentKPIdCrm'];
    $statusProgress = $_POST['statusProgress'];
    $nik = $_SESSION['nik'];
    $update_at = date("Y-m-d H:i:s");

    /*whole data save to histinputcrm*/
    $sqlGet = mysqli_query($Open, "select * from tb_inputcrm where id_crm = '$idCrm'");
    $resultGet = mysqli_fetch_array($sqlGet);
    $sqlHist = mysqli_query($Open, "insert into histinputcrm VALUES (''
                                                                          ,'$resultGet[0]'
                                                                          ,'$resultGet[1]'
                                                                          ,'$resultGet[2]'
                                                                          ,'$resultGet[3]'
                                                                          ,'$resultGet[4]'
                                                                          ,'$resultGet[5]'
                                                                          ,'$resultGet[6]'
                                                                          ,'$resultGet[7]'
                                                                          ,'$resultGet[8]'
                                                                          ,'$resultGet[9]'
                                                                          ,'$resultGet[10]'
                                                                          ,'$resultGet[11]'
                                                                          ,'$update_at'
                                                                          )");
    // update  data tb_detsla
   $sqlUpdateDetSla = mysqli_query($Open, "update tb_detsla set out_date = '$update_at' where id_crm = '".$idCrm."' and in_date = '".$resultGet[11]."'");

   // kemudian create data detsla baru dengan out date sebelumnya menjadi in date dalam data yang baru
    $sqlNewDetSla = mysqli_query($Open, "insert into tb_detsla VALUES ('', '$idCrm', '$statusProgress', '$nik', '$update_at', '')");

    if($sqlHist){
        $status = 'ok';
        $sql = mysqli_query($Open, "update tb_inputcrm set status = '$statusProgress', nik_user = '$nik' , update_at = '$update_at' where id_crm = '$idCrm'");
    }else {
        $status = 'sql';
    }
    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}