<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idCrm'])&& isset($_SESSION['nik'])){
    $idCrm = $_POST['idCrm'];
    $nik = $_SESSION['nik'];

    $nopk = $_POST['no_pk'];
    $tglPengurusan = $_POST['tglPengurusan'];
    $tglTarget = $_POST['tglTarget'];
    $tglPemenuhan = $_POST['tglPemenuhan'];
    $tglKhasanah = $_POST['tglKhasanah'];
    $statusProgress = $_POST['status-progress'];
    $keterangan = $_POST['keterangan-sign'];

    $createAt = date("Y-m-d H:i:s");

    // cek sudah pernah sign in atau belum
    $sqlCek = mysqli_query($Open, "select * from tb_inputsignpk where id_crm = '$idCrm'");
    $rows = mysqli_num_rows($sqlCek);
    if($rows > 0){
        $status = 'ada';
    }else{
        if($statusProgress == 1){
            //get data detsla
            $getDetSla = mysqli_query($Open,"select status, in_date from tb_detsla where id_crm = '$idCrm' order by status desc limit 1");
            $resultDetSla = mysqli_fetch_array($getDetSla);
            if($resultDetSla['status'] == 7){
                // insert detsla
                $sqlInsertDetSla = mysqli_query($Open, "insert into tb_detsla values ('', '".$idCrm."', '".$statusProgress."', '".$nik."', '".$createAt."','') ");

                // then update detsla sebelumnya
                $sqlUpdateDetSla = mysqli_query($Open, "update tb_detsla set out_date = '".$createAt."' where id_crm = '".$idCrm."' and status = '".$resultDetSla['status']."' and in_date = '".$resultDetSla['in_date']."' ");

                if($sqlInsertDetSla && $sqlUpdateDetSla){
                    $sql = mysqli_query($Open, "insert into tb_inputsignpk VALUES (''
                                                                        ,'".$idCrm."'
                                                                        ,'".$nopk."'
                                                                        ,'".$tglPengurusan."'
                                                                        ,'".$tglTarget."'
                                                                        ,'".$tglPemenuhan."'
                                                                        ,'".$tglKhasanah."'
                                                                        ,'".$statusProgress."'
                                                                        ,'".$keterangan."'
                                                                        ,'".$nik."'
                                                                        ,'".$createAt."'
                                                                        ,'')");
                    // then update tb_inputcrm with current status
                    $sqlUpdateCrm = mysqli_query($Open, "update tb_inputcrm set status = '".$statusProgress."', update_at = '".$createAt."' where id_crm = '".$idCrm."'");
                    if($sqlUpdateCrm){
                        // get data tb_inputcrm
                        $sqlGetInputCrm = mysqli_query($Open, "select * from tb_inputcrm where id_crm = '".$idCrm."'");
                        $resultGetInputCrm = mysqli_fetch_array($sqlGetInputCrm);
                        // then insert into histinputcrm
                        $insertIntoHistCrm = mysqli_query($Open, "insert into histinputcrm VALUES (''
                                                                                                         , '".$resultGetInputCrm[0]."'
                                                                                                         , '".$resultGetInputCrm[1]."'
                                                                                                         , '".$resultGetInputCrm[2]."'
                                                                                                         , '".$resultGetInputCrm[3]."'
                                                                                                         , '".$resultGetInputCrm[4]."'
                                                                                                         , '".$resultGetInputCrm[5]."'
                                                                                                         , '".$resultGetInputCrm[6]."'
                                                                                                         , '".$resultGetInputCrm[7]."'
                                                                                                         , '".$resultGetInputCrm[8]."'
                                                                                                         , '".$resultGetInputCrm[9]."'
                                                                                                         , '".$resultGetInputCrm[10]."'
                                                                                                         , '".$resultGetInputCrm[11]."'
                                                                                                         , '".$createAt."')");
                    }

                }
            }

        }else {
            $sql = mysqli_query($Open, "insert into tb_inputsignpk VALUES (''
                                                                        ,'".$idCrm."'
                                                                        ,'".$nopk."'
                                                                        ,'".$tglPengurusan."'
                                                                        ,'".$tglTarget."'
                                                                        ,''
                                                                        ,'".$tglKhasanah."'
                                                                        ,'".$statusProgress."'
                                                                        ,'".$keterangan."'
                                                                        ,'".$nik."'
                                                                        ,'".$createAt."'
                                                                        ,'')");
        }


        if($sql){
            $status = 'ok';
        }else {
            $status = 'sql';
        }
    }
    echo $status;die;
}else {
    $status = 'Error';
    echo $status;die;
}