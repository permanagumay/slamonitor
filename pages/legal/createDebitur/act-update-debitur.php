<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_POST['idCrmDebiturUpdate']) && isset($_SESSION['nik'])) {
    $idCrm = $_POST['idCrmDebiturUpdate'];
    $nik = $_SESSION['nik'];

    $marketing = $_POST['marketingUpdate'];
    $tglCRM = $_POST['dateTerimaCRMUpdate'];
    $namaDebitur = $_POST['nama_debiturUpdate'];
    $CIF = $_POST['nomor_cifUpdate'];
    $PPK = $_POST['nomor_ppkUpdate'];
    $CRM = $_POST['nomor_crmUpdate'];
    $updateAt = date("Y-m-d H:i:s");

    //ambil nik marketing
    $cekMarketing = mysqli_query($Open, "select nik_marketing from master_marketing where id_marketing = $marketing");
    $resultMarketing = mysqli_fetch_array($cekMarketing);

    // cek cif sudah ada atau tidak
    $sqlCekCif = mysqli_query($Open, "SELECT nama_debitur
                                                    , cif
                                                    ,(select ppk from tb_inputcrm where cif = '$CIF' and ppk = '$PPK' and id_crm <> '$idCrm')as ppk
                                                    ,(select crm from tb_inputcrm where cif = '$CIF' and crm = '$CRM' and id_crm <> '$idCrm')as crm  
                                                    FROM `tb_inputcrm` 
                                                    WHERE cif = '$CIF' and id_crm <> '$idCrm' limit 1");
    if ($row = mysqli_num_rows($sqlCekCif) > 0) {
        while ($data = mysqli_fetch_array($sqlCekCif)) {
            if ($data[2] == $PPK) {
                $status = 'PPK';
                break;
            } else {
                if ($data[3] == $CRM) {
                    $status = 'CRM';
                    break;
                } else {
                    $sql = mysqli_query($Open, "update tb_inputcrm set
                                          nik_marketing = '" . $resultMarketing[0] . "'
                                          ,nama_debitur = '".$namaDebitur."'
                                          ,tgl_terimacrm = '" . $tglCRM . "'
                                          ,cif = '" . $CIF . "'
                                          ,ppk = '" . $PPK . "'
                                          ,crm = '" . $CRM . "'
                                          ,nik_user = '" . $nik . "'
                                          ,update_at = '" . $updateAt . "'               
                                      where id_crm = '" . $idCrm . "'");

                    if ($sql) {
                        $status = 'ok';
                        // insert to HistInputCrm
                        $sqlHist = mysqli_query($Open, "insert into histinputcrm VALUES (''
                                                                                ,'" . $idCrm . "'
                                                                                ,'".$namaDebitur."'
                                                                                ,'" . $resultMarketing[0] . "'
                                                                                ,'" . $tglCRM . "'
                                                                                ,'" . $CIF . "'
                                                                                ,'" . $PPK . "'
                                                                                ,'" . $CRM . "'
                                                                                ,'" . $nik . "'
                                                                                ,''
                                                                                ,''
                                                                                ,'" . $updateAt . "'
                                                                                ,'')");
                    } else {
                        $status = 'sql';
                    }
                    break;

                }
            }
        }

    }else {
        $sql = mysqli_query($Open, "update tb_inputcrm set
                                          nik_marketing = '" . $resultMarketing[0] . "'                                          
                                          ,nama_debitur = '".$namaDebitur."'
                                          ,tgl_terimacrm = '" . $tglCRM . "'
                                          ,cif = '" . $CIF . "'
                                          ,ppk = '" . $PPK . "'
                                          ,crm = '" . $CRM . "'
                                          ,update_at = '" . $updateAt . "'               
                                      where id_crm = '" . $idCrm . "'");

        if ($sql) {
            $status = 'ok';
            // insert to HistInputCrm
            $sqlHist = mysqli_query($Open, "insert into histinputcrm VALUES (''
                                                                                ,'" . $idCrm . "'                                                                                
                                                                                ,'".$namaDebitur."'
                                                                                ,'" . $resultMarketing[0] . "'
                                                                                ,'" . $tglCRM . "'
                                                                                ,'" . $CIF . "'
                                                                                ,'" . $PPK . "'
                                                                                ,'" . $CRM . "'
                                                                                ,'" . $nik . "'
                                                                                ,''
                                                                                ,''
                                                                                ,'" . $updateAt . "'
                                                                                ,'')");
        } else {
            $status = 'sql';
        }

    }

    echo $status;
    die;
} else {
    $status = 'error';
    echo $status;
    die;

}