<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_POST['id_inputDoc'])&& isset($_SESSION['nik'])){
    $idInputDoc = $_POST['id_inputDoc'];
    $nik = $_SESSION['nik'];

    $JenDoc = $_POST['selectDocumentUpdate'];
    $docLain = $_POST['docLainnyaUpdate'];
    $tglPengurusan = $_POST['TglMulaiDocUpdate'];
    $tglTarget = $_POST['TglTargetDocUpdate'];

    $update_at = date("Y-m-d H:i:s");

    $sql = mysqli_query($Open, "update tb_inputdoc  set
                                        id_doc = '".$JenDoc."'
                                        ,doc_lain = '".$docLain."'
                                        ,tgl_pengurusan = '".$tglPengurusan."'
                                        ,tgl_target = '".$tglTarget."'
                                        ,update_at = '".$update_at."'
                                      where id_inputdoc = '".$idInputDoc."'" );

    if($sql){
        $status = 'ok';
        // insert into histinputdoc
        $sqlHist = mysqli_query($Open, "insert into histinputdoc values(''
                                                                              ,'".$idInputDoc."'
                                                                              ,'".$JenDoc."'
                                                                              ,'".$docLain."'
                                                                              ,'".$tglPengurusan."'
                                                                              ,'".$tglTarget."'
                                                                              ,''
                                                                              ,''
                                                                              ,'".$nik."'
                                                                              ,'".$update_at."'
                                                                              ,'')");
    }else {
        $status = 'sql';
    }

    echo $status;die;

}else {
    echo "<p>Data Error</p>";
}