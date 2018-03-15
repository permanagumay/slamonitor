<?php
require_once "../../../assets/koneksi.php";
session_start();
if(isset($_POST['idJaminanUpdate'])&& isset($_SESSION['nik'])){
    $idJaminan = $_POST['idJaminanUpdate'];
    $nik = $_SESSION['nik'];

    $tglPenyelesaian = $_POST['updateTglPenyelesaian'];
    $statusProgress = $_POST['status-progressUpdate'];
    $updateAt = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputjaminan 
                                        set tgl_penyelesaian = '".$tglPenyelesaian."'
                                            ,status = '".$statusProgress."'
                                            ,update_at = '".$updateAt."'
                                      where id_agunan = '".$idJaminan."'");

    if($sql){
        $status = 'ok';
        //insert into histinputjaminan
        $sqlHist = mysqli_query($Open, "insert into histinputjaminan VALUES (''
                                                                                    ,'".$idJaminan."'
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,''
                                                                                    ,'".$tglPenyelesaian."'
                                                                                    ,''
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

