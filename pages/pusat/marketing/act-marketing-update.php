<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idMarketingUpdate']) && isset($_SESSION['nik'])){
    $idMarketing = $_POST['idMarketingUpdate'];
    $nik = $_SESSION['nik'];

    $cabang = $_POST['selectCabangUpdate'];
    $nikMarketing = $_POST['nik-marketingUpdate'];
    $nama = $_POST['nama-marketingUpdate'];
    $code = $_POST['code-hoUpdate'];
    $aktif = $_POST['status-aktifUpdate'];
    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update master_marketing set
                                          nik_marketing = '".$nikMarketing."' 
                                          ,nama_marketing = '".$nama."'
                                          ,code_ho = '".$code."'
                                          ,id_cabang = '".$cabang."'
                                          ,aktif = '".$aktif."'
                                          ,nik_user = '".$nik."'
                                          ,update_at = '".$updateAt."'
                                       where id_marketing = '".$idMarketing."'");

    if($sql){
        $status = 'ok';
    }else {
        $status = 'sql';
    }
    echo $status;die;
}else {
    $status = 'error';
    echo $status;die;
}