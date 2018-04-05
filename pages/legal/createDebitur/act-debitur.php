<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['nomor_cif']) && isset($_SESSION['nik'])){
    $nik = $_SESSION['nik'];

    $cabang = $_POST['cabang'];
    $marketing = $_POST['marketing'];
    $namaDebitur = $_POST['nama_debitur'];
    $tglTerimaCrm = $_POST['dateTerimaCRM'];
    $CIF = $_POST['nomor_cif'];
    $PPK = $_POST['nomor_ppk'];
    $CRM = $_POST['nomor_crm'];
    $statusAplikasi = 3;
    $create_at = date("Y-m-d H:i:s");

    //ambil nik marketing
    $cekMarketing = mysqli_query($Open, "select nik_marketing from master_marketing where id_marketing = $marketing");
    $resultMarketing = mysqli_fetch_array($cekMarketing);


    $sqlCekCif = mysqli_query($Open, "SELECT nama_debitur
                                                  , cif
                                                  ,(select ppk from tb_inputcrm where cif = '$CIF' and ppk = '$PPK')as ppk
                                                  ,(select crm from tb_inputcrm where cif = '$CIF' and crm = '$CRM')as crm  
                                                  FROM `tb_inputcrm` 
                                            WHERE cif = '$CIF' limit 1 ");

    // cek cif sudah ada atau tidak
    if($rowCekCif = mysqli_num_rows($sqlCekCif) > 0 ){
        $i = 0;
        while($dataCekCif = mysqli_fetch_array($sqlCekCif)){

            if($dataCekCif[0] != $namaDebitur){
                $status = 'tidak sesuai';
            }else {
                if($dataCekCif[2] == $PPK){
                    $status = 'PPK';
                    break;
                }else {
                    if($dataCekCif[3] == $CRM){
                        $status = 'CRM';
                        break;
                    }else {
                        $sql = mysqli_query($Open, "insert into tb_inputcrm values(''
                                                                          ,'" . $namaDebitur . "'
                                                                          ,'" . $cabang . "'
                                                                          ,'" . $resultMarketing[0] . "'
                                                                          ,'" . $tglTerimaCrm . "'
                                                                          ,'" . $CIF . "'
                                                                          ,'" . $PPK . "'
                                                                          ,'" . $CRM . "'
                                                                          ,'" . $nik . "'
                                                                          ,'" . $statusAplikasi . "'
                                                                          ,'' 
                                                                          ,'" . $create_at . "'
                                                                          ,'')");

                        if($sql){
                            // get data id_crm
                            $sqlToSla = mysqli_query($Open, "select id_crm from tb_inputcrm where cif = '$CIF' and ppk = '$PPK' and crm = '$CRM'");
                            $resultToSla = mysqli_fetch_array($sqlToSla);

                            // then save id_crm to tb_detsla
                            $sqlSaveToSla = mysqli_query($Open, "insert into tb_detsla VALUES ('', '".$resultToSla[0]."', '".$statusAplikasi."', '".$nik."', '".$create_at."', '')");

                            $status = 'ok';
                        }else {
                            $status = 'sql';
                        }
                        break;

                    }
                }
            }
            $i++;
        }
        echo $status;die;
    }else {
        $sql = mysqli_query($Open, "insert into tb_inputcrm values(''
                                                                          ,'" . $namaDebitur . "'
                                                                          ,'" . $cabang . "'
                                                                          ,'" . $resultMarketing[0] . "'
                                                                          ,'" . $tglTerimaCrm . "'
                                                                          ,'" . $CIF . "'
                                                                          ,'" . $PPK . "'
                                                                          ,'" . $CRM . "'
                                                                          ,'" . $nik . "'
                                                                          ,'" . $statusAplikasi . "'
                                                                          ,'' 
                                                                          ,'" . $create_at . "'
                                                                          ,'')");

        if($sql){
            // get data id_crm
            $sqlToSla = mysqli_query($Open, "select id_crm from tb_inputcrm where cif = '$CIF' and ppk = '$PPK' and crm = '$CRM'");
            $resultToSla = mysqli_fetch_array($sqlToSla);

            // then save id_crm to tb_detsla
            $sqlSaveToSla = mysqli_query($Open, "insert into tb_detsla VALUES ('', '".$resultToSla['id_crm']."', '".$statusAplikasi."', '".$nik."', '".$create_at."', '')");

            $status = 'ok';
        }else {
            $status = 'sql';
        }
    }
    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}