<?php

include "assets/koneksi.php";
session_start();
if(isset($_SESSION['nik']) && isset($_SESSION['id_cabang'])){
    $idCabang = $_SESSION['id_cabang'];
    $sql = mysqli_query($Open, "select a.id_crm
                                              ,a.cif
                                              ,a.ppk
                                              ,a.crm
                                              ,b.status_progress
                                              ,a.create_at
                                              ,a.nama_debitur
                                              ,a.cabang
                                              ,e.status as statusSign
                                              ,e.create_at
                                              ,a.status
                                      from tb_inputcrm a 
                                      left join master_statusaplikasi b on a.status = b.id_progress
                                      inner join user c on a.nik_user = c.nik
                                      left join cabang d on c.id_cabang = d.id_cabang
                                      left join tb_inputsignpk e on a.id_crm = e.id_crm
                                      where a.status != 3 order by a.create_at DESC ");
    ?>
    <ul class="breadcrumb">
        <li class="active">Dashboard Page</li>
    </ul>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <table id="tableDashboard1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Cabang</th>
                                <th style="text-align: center">No. CIF</th>
                                <th style="text-align: center">No. PPK</th>
                                <th style="text-align: center">No. CRM</th>
                                <th style="text-align: center">Debitur</th>
                                <th style="text-align: center">Status Aplikasi</th>
                                <th style="text-align: center">Posisi</th>
                                <th style="text-align: center">Hari Ke-</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no = 0;
                            while($row = mysqli_fetch_array($sql)){
                                //jika status sign-in = 1 maka sla dianggap selesai
                                if($row[8] == 1){
                                    $tglCreate = date_create($row[5]);
                                    $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                    $tglSignIn = date_create($row[9]);
                                    $dtSignin = strtotime(date_format($tglSignIn, "Y-m-d"));
                                    $selisih = abs($dtSignin-$dtCreate);
                                    $sla = $selisih/86400; // 86400 jumlah detik dalam sehari
                                }else {
                                    $tglCreate = date_create($row[5]);
                                    $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                    $dtNow =  strtotime(date("Y-m-d"));
                                    $selisih = abs($dtNow-$dtCreate);
                                    $sla = $selisih/86400; // 86400 jumlah detik dalam sehari
                                }

                                if($row[10]== 5){
                                    $posNow = 'Pusat';
                                }else {
                                    $posNow = 'Cabang';
                                }

                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$no+1?></td>
                                    <td><?=$row[7]?></td>
                                    <td><?=$row[1]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[6]?></td>
                                    <td style="text-align: center"><?=$row[4]?></td>
                                    <td style="text-align: center"><?=$posNow?></td>
                                    <td style="text-align: center"><?=$sla?></td>
                                    <td align="center">
                                        <a href="home-pusat.php?page=form-detailNasabah&id_crm=<?=$row[0];?>" title="Detail">
                                            <i class="fa  fa-twitch"></i>
                                        </a>
                                    </td>
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
    <script type="text/javascript">
        $(function () {
            $("#tableDashboard1").DataTable();
            $('#tableDashboard2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });


    </script>
    <?php
}else {
    echo "Data Error";
}



