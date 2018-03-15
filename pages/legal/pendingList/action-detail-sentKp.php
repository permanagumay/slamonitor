<?php
include "../../../assets/koneksi.php";
session_start();
/*if(isset($_POST['id_crm_kp']) && isset($_SESSION['nik'])){

    $idCrm = $_POST['id_crm_kp'];
    $status = 5;
    $nik = $_SESSION['nik'];
    $update_at = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputcrm set status = '$status'
                                                            , nik_user = '$nik'
                                                            , update_at = '$update_at' 
                                      where id_crm = '$idCrm'");
    if($sql){
        $status = 'ok';
    }else {
        $status = 'sql';
    }
    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}*/

$status = 'ok';
echo $status;die;