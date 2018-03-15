<?php

ini_set('display_errors', 'off');
date_default_timezone_set('Asia/Jakarta');
$Open = mysqli_connect("localhost","root","");


if (!$Open){
    die ("Koneksi ke Engine MySQL Gagal !<br>");
}
$KoneksiDB = mysqli_select_db($Open,"db_crm");
if (!$KoneksiDB){
    die ("Koneksi ke Database Gagal !");
}



function getMasterCovenant(){
    GLOBAL $Open;
    $sql = mysqli_query($Open, "select * from master_syaratcovenant where id_syarat !=5");
    $no = 1;
    while($row = mysqli_fetch_array($sql)){
        echo "<input type='checkbox' value='".$row[0]."' name='mascov".$no."' id='mascov' onChange=''/> ".$row[1]."<br/>";
        $no++;
    }

}

function getMasterCovenantCombo(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_syaratcovenant");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterDocument(){
    GLOBAL $Open;
    $sql = mysqli_query($Open, "select * from master_document where id_masterdoc != 7");
    $no = 1;
    while($row = mysqli_fetch_array($sql)){
        echo "<input type='checkbox' value='".$row['0']."' name='masdoc".$no."'/> ".$row['1']."<br/>";
        $no++;
   }
}


function getMasterProgress(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_statusprogress");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterDeviasi(){
    GLOBAL $Open;
    $sql = mysqli_query($Open, "select * from master_deviasi where id_masterdeviasi !=6");
    $no = 1;
    while($row = mysqli_fetch_array($sql)){
        echo "<input type='checkbox' value='".$row[0]."' name='masdev".$no."'/> ".$row[1].",".$row[2]."".$row[0]."<br/>";
        $no++;
    }

}

function getMasterDeviasiCombo(){
    GLOBAL $Open;
    $sql = mysqli_query($Open, "select * from master_deviasi");
    $no = 1;
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        $no++;
    }

}

function getMasterAgunan(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_jenisagunan where id_jenisagunan != 3 ");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterPengikatan(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_jenispengikatanagunan");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getFlagAsuransi(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from flag_asuransi");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterObjekAsuransi(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_objekasuransi");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

/*function getMasterJenisAsuransi(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_jenisasuransi");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}*/

function getMasterJenisAsuransiJaminan(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_jenisasuransi where id_jenisasuransi != 2");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterJenisAsuransiFasilitas(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_jenisasuransi where id_jenisasuransi != 1");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getObjekAsuransi(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_objekasuransi");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterFasilitas(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_fasilitas");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}



function getMasterPengikatanNotaris(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_pengikatan");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getMasterCabang(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from cabang");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[2] . '</option>';
    }
}

function getMarketing($cabang){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_marketing where id_cabang = '$cabang' and aktif = 'Y'");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[2] . '</option>';
    }
}

function getCabangInput($cabang){
    Global $Open;
    $sql = mysqli_query($Open, "select company_name from cabang where id_cabang ='$cabang'");
    $result = mysqli_fetch_array($sql);

    echo "$result[0]";

}

function getTipeKredit(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_tipekredit");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }

}

function getJaminanByIdCrm($idcrm){
    Global $Open;
    $sql = mysqli_query($Open, "SELECT a.id_agunan, b.jenis_agunan, a.no_certificate, a.nilai_penjaminan
                                                                                     FROM `tb_inputjaminan` a
                                                                                     left join master_jenisagunan b on a.jaminan = id_jenisagunan
                                                                                     where a.id_crm = '$idcrm'");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . ',' . $row[2] . ',' . $row[3] . '</option>';

    }
}

function getStatusProgress(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_statusprogress where id_progress != 2");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function getStatusAplikasi(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_statusaplikasi where id_progress != 1 and id_progress != 2 and id_progress != 5 and id_progress != 6 ");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }

}

function getDokument(){
    Global $Open;
    $sql = mysqli_query($Open, "select * from master_document ");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}

function logLogin($nik){
    Global $Open;
    $date = date("Y-m-d H:i:s");
    $sql = mysqli_query($Open, "insert into log_login VALUES ('','".$nik."',1,'".$date."','' )");
}

function logLogOut($nik){
    Global $Open;
    $date = date("Y-m-d H:i:s");
    $sql = mysqli_query($Open, "update log_login set last_logout = '".$date."', status = 0 where id_user = '".$nik."' order by no_login desc limit 1 ");
}







