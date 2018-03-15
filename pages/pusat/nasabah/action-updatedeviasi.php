<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idInputDeviasi'])&& isset($_SESSION['nik'])){
    $idInputDeviasi = $_POST['idInputDeviasi'];
    $nik = $_SESSION['nik'];

    $tgl_pemenuhan = $_POST['TglPemenuhanDevUpdate'];
    $statusProgress = $_POST['status-progressUpdate'];
    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputdeviasi set
                                          tgl_pemenuhan = '$tgl_pemenuhan'
                                          ,status_progress = '$statusProgress'
                                          ,update_at = '$updateAt'
                                      where id_inputdeviasi = '$idInputDeviasi'");

    if($sql){
        $status = 'ok';
        // insert into histinputdeviasi
        $sqlHist = mysqli_query($Open, "insert into histinputdeviasi VALUES (''
                                                                                    ,'".$idInputDeviasi."'
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''                                                                                    
                                                                                    ,'".$tgl_pemenuhan."'
                                                                                    ,'".$statusProgress."'
                                                                                    ,''
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