<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['id_crm_detail_nasabah'])&& isset($_SESSION['nik'])){
    $idCrm = $_POST['id_crm_detail_nasabah'];
    $nik = $_SESSION['nik'];

    $statusProgress = $_POST['status-progress'];
    $statusKeterangan = $_POST['status-keterangan'];
    $updateAt = date("Y-m-d H:i:s");

    /*jika status sudah approve tidak bisa on progress lagi*/
    $sqlCekStatus = mysqli_query($Open, "select status, update_at from tb_inputcrm where id_crm ='$idCrm'");
    $resultCekStatus = mysqli_fetch_array($sqlCekStatus);

    // menghitung jumlah hari
    // digunakan agar status reject lebih 90 hari tidak boleh ada perubahan status lagi
    $tglCreate = date_create($resultCekStatus[1]);
    $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
    $dtNow =  strtotime(date("Y-m-d"));
    $selisih = abs($dtNow-$dtCreate);
    $countDays = $selisih/86400; // 86400 jumlah detik dalam sehari

    // jika status == approve, kemudian di reject
    if($resultCekStatus[0] == 7){
        if($statusProgress == 4){
            //simpan data sebelumnya, kemudian simpan ke histinputcrm
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
                                                                          ,'$updateAt'
                                                                          )");

            // update  data tb_detsla
            $sqlUpdateDetSla = mysqli_query($Open, "update tb_detsla set out_date = '$updateAt' where id_crm = '".$idCrm."' and in_date = '".$resultGet[12]."'");

            // kemudian create data detsla baru dengan out date sebelumnya menjadi in date dalam data yang baru
            $sqlDetSla = mysqli_query($Open, "insert into tb_detsla VALUES ('', '".$idCrm."', '".$statusProgress."', '".$nik."', '".$resultGet[12]."', '".$updateAt."')");
            if($sqlHist){
                $status = 'reject';
                $sql = mysqli_query($Open, "update tb_inputcrm  set status = '$statusProgress',nik_user = '$nik' ,keterangan = '$statusKeterangan',update_at = '$updateAt'
                                           where id_crm = '$idCrm'");

            }else {
                $status = 'sql';
            }
        }else {
            $status = 'can-not';
        }
    // jika status == reject dan melebihi 90 hari, status tidak bisa diupdate
    }else if($resultCekStatus[0] == 4 && $countDays >= 90){
        $status = 'can not restatus';
    }else {
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
                                                                          ,'$nik'
                                                                          ,'$resultGet[9]'
                                                                          ,'$resultGet[10]'
                                                                          ,'$resultGet[11]'
                                                                          ,'$updateAt'
                                                                          )");

        // update  data tb_detsla
        $sqlUpdateDetSla = mysqli_query($Open, "update tb_detsla set out_date = '$updateAt' where id_crm = '".$idCrm."' and in_date = '".$resultGet[12]."'");

        // kemudian create data detsla baru dengan out date sebelumnya menjadi in date dalam data yang baru
        $sqlNewDetSla = mysqli_query($Open, "insert into tb_detsla VALUES ('', '$idCrm', '$statusProgress', '$nik', '$updateAt', '')");

        if($sqlHist){
            $status = 'ok';
            $sql = mysqli_query($Open, "update tb_inputcrm  set status = '$statusProgress',keterangan = '$statusKeterangan',update_at = '$updateAt' where id_crm = '$idCrm'");
        }else {
            $status = 'sql';
        }

    }
    echo $status;die;
}else {
    $status = 'Error';
    echo $status;die;
}
