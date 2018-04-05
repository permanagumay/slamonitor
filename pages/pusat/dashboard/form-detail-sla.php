<?php
date_default_timezone_set('Asia/Jakarta');
include "assets/koneksi.php";
session_start();
if (isset($_GET['id_crm']) && isset($_SESSION['nik'])) {
    $idCrm = $_GET['id_crm'];
    $sql = mysqli_query($Open, "select status, nik, in_date, out_date from tb_detsla where id_crm = '$idCrm'");

    // cek signpk
    $cekPk = mysqli_query($Open, "select tgl_pemenuhan from tb_inputsignpk where id_crm = '$idCrm' ");
    $resultPk = mysqli_fetch_array($cekPk);

?>
    <div class="box box-body">
        <section class="content">
            <ul class="breadcrumb">
                <li class="active">Detail SLA</li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body">
                            <table id="tableDashboard1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="text-align: center">No.</th>
                                    <th style="text-align: center">Position</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Date Create</th>
                                    <th style="text-align: center">Count Days</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $no = 0;
                                    while($row = mysqli_fetch_array($sql)){
                                        if($row[0] == 3 ){
                                            $posisi = 'Cabang';
                                            $status = 'On Progress';
                                            // jika out date status 3 kosong gunakan out date tgl hari ini
                                            if($row[3] == '' || $row[3] == '0000-00-00 00:00:00'){
                                                $tglCreate = date_create($row[2]);
                                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                $dtNow =  strtotime(date("Y-m-d"));
                                                $selisih = abs($dtNow-$dtCreate);
                                                $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                            }else {
                                                $tglCreate = date_create($row[2]);
                                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                $tglOutDate = date_create($row[3]);
                                                $outDate = strtotime(date_format($tglOutDate, "Y-m-d"));
                                                $selisih = abs($outDate-$dtCreate);
                                                $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                            }
                                        }else if($row[0] == 5) {
                                            $posisi = 'Pusat';
                                            $status = 'Review Progress';
                                            // jika out date status 5 kosong gunakan out date tgl hari ini
                                            if($row[3] == '' || $row[3] == '0000-00-00 00:00:00'){
                                                $tglCreate = date_create($row[2]);
                                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                $dtNow =  strtotime(date("Y-m-d"));
                                                $selisih = abs($dtNow-$dtCreate);
                                                $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                            }else {
                                                $tglCreate = date_create($row[2]);
                                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                $tglOutDate = date_create($row[3]);
                                                $outDate = strtotime(date_format($tglOutDate, "Y-m-d"));
                                                $selisih = abs($outDate-$dtCreate);
                                                $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                            }
                                        }else if($row[0] == 7){
                                            $posisi = 'Cabang';
                                            $status = 'Approve';
                                            // jika out date status 7 kosong gunakan out date signpk jika masi kosong gunakan tgl hari ini
                                            if($row[3] == '' || $row[3] == '0000-00-00 00:00:00'){
                                                if($resultPk['tgl_pemenuhan'] == '' || $resultPk['tgl_pemenuhan'] == '0000-00-00'){
                                                    $tglCreate = date_create($row[2]);
                                                    $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                    $dtNow =  strtotime(date("Y-m-d"));
                                                    $selisih = $dtNow-$dtCreate;
                                                    $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                                }else {
                                                    $tglCreate = date_create($row[2]);
                                                    $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                    $tglPk = date_create($resultPk['tgl_pemenuhan']);
                                                    $tglPemenuhanPk = strtotime(date_format($tglPk, "Y-m-d"));
                                                    $selisih = abs($tglPemenuhanPk-$dtCreate);
                                                    $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                                }
                                            }else {
                                                $tglCreate = date_create($row[2]);
                                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                                $tglOutDate = date_create($row[3]);
                                                $outDate = strtotime(date_format($tglOutDate, "Y-m-d"));
                                                $selisih = abs($outDate-$dtCreate);
                                                $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                            }

                                        }else if($row[0] == 1){
                                            $posisi = 'Sign PK Cabang';
                                            $status = 'Done';

                                            // get create_at dari tb_inputcrm
                                            $sqlcrm = mysqli_query($Open, "select create_at from tb_inputcrm where id_crm = '$idCrm'");
                                            $resultcrm = mysqli_fetch_array($sqlcrm);
                                            $tglCreate = date_create($resultcrm['create_at']);
                                            $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));

                                            // out date diambil dari in_date detsla
                                            $tglOutDate = date_create($row[2]);
                                            $outDate = strtotime(date_format($tglOutDate, "Y-m-d"));
                                            $selisih = abs($outDate-$dtCreate);
                                            $days = $selisih/86400; // 86400 jumlah detik dalam sehari

                                        }else if ($row[0] == 4){
                                            $posisi = 'Pusat';
                                            $status = 'Reject';
                                            $tglCreate = date_create($row[2]);
                                            $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                            $dtNow =  strtotime(date("Y-m-d"));
                                            $selisih = $dtNow-$dtCreate;
                                            $days = $selisih/86400; // 86400 jumlah detik dalam sehari
                                        }
                                ?>
                                    <tr>
                                        <td style="text-align: center"><?=$no+1?></td>
                                        <td><?=$posisi?></td>
                                        <td><?=$status?></td>
                                        <td><?=$row[2]?></td>
                                        <td style="text-align:right"><?=$days?></td>
                                    </tr>
                                <?php
                                        $no++;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}
