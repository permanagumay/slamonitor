<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputCovenant'])&& isset($_SESSION['nik'])){
    $idInputCovenant = $_POST['idInputCovenant'];
    $nik = $_SESSION['nik'];

    $tglPemenuhan = $_POST['TglPenyelesaianUpdateCovenant'];
    $statusProgress = $_POST['status-progressUpdate'];
    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputcovenant set tgl_pemenuhan = '$tglPemenuhan'
                                                                  ,status_progress = '$statusProgress'
                                                                  ,update_at = '$updateAt' where id_input_covenant = '$idInputCovenant'  ");

    if($sql){
        $status = 'ok';
        // insert into histinputcovenant
        $sqlHist = mysqli_query($Open, "insert into histinputcovenant VALUES (''
                                                                                    ,'".$idInputCovenant."'
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,'".$tglPemenuhan."'
                                                                                    ,'".$statusProgress."'
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