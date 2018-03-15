<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['id_inputDoc'])&& isset($_SESSION['nik'])){
    $idInputDoc = $_POST['id_inputDoc'];
    $nik = $_SESSION['nik'];

    $tglPemenuhan = $_POST['TglPemenuhanDocUpdate'];
    $statusProgress = $_POST['status-progressUpdate'];

    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputdoc set
                                        tgl_pemenuhan = '$tglPemenuhan'
                                        ,status = '$statusProgress'
                                        ,update_at = '$updateAt'
                                      where id_inputdoc = '$idInputDoc' ");

    if($sql){
        $status = 'ok';
        // insert into histinputdoc
        $sqlHist = mysqli_query($Open, "insert into histinputdoc VALUES (''
                                                                                ,'".$idInputDoc."'
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
    echo "<p>Data Error</p>";
}