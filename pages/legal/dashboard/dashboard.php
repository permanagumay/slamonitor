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
                                             ,a.status
                                             ,e.status_progress
                                             ,d.tgl_pemenuhan
                                             ,d.status
                                             ,a.keterangan 
                                      from tb_inputcrm a 
                                      left join master_statusaplikasi b on a.status = b.id_progress
                                      left join cabang c on a.cabang = c.company_name
                                      left join tb_inputsignpk d on a.id_crm = d.id_crm
                                      left join master_statusprogress e on d.status = e.id_progress
                                      where a.status != 3 and c.id_cabang = '$idCabang' order by a.create_at DESC ");


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
                                <th style="text-align: center">No. CIF</th>
                                <th style="text-align: center">No. PPK</th>
                                <th style="text-align: center">No. CRM</th>
                                <th style="text-align: center">Debitur</th>
                                <th style="text-align: center">Status-Aplikasi</th>
                                <th style="text-align: center">Keterangan</th>
                                <th style="text-align: center">Status Sign PK</th>
                                <th style="text-align: center">Sign PK</th>
                                <th style="text-align: center">Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no = 0;
                            while($row = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$no+1?></td>
                                    <td><?=$row[1]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[6]?></td>
                                    <td style="text-align: center"><?=$row[4]?></td>
                                    <td style="text-align: center"><?=$row[11]?></td>
                                    <td style="text-align: center"><?=$row[8]?></td>

                                    <?php
                                        if($row[7] == 7 || $row[7] == 1){ // jika status aplikasi approved
                                    ?>
                                            <td align="center">
                                                <a href="home-legal.php?page=form-signin&idCrm=<?=$row[0];?>" title="Sign-in">
                                                    <i class="fa  fa-twitch"></i>
                                                </a>
                                            </td>
                                            <?php
                                                if($row[10] == 'Done'){ // jika status sign-in done
                                            ?>
                                                    <td align="center">
                                                        <a href="home-legal.php?page=form-detail-dashboard&idCrm=<?=$row[0];?>" title="Detail">
                                                            <i class="fa  fa-windows"></i>
                                                        </a>
                                                    </td>
                                            <?php
                                                }else {
                                            ?>
                                                    <td align="center">
                                                        <a href="home-legal.php?page=form-detail-dashboard&idCrm=<?=$row[0];?>" title="Detail">
                                                            <i class="fa  fa-windows"></i>
                                                        </a>
                                                    </td>
                                            <?php
                                                }

                                            ?>

                                    <?php
                                        }else {
                                    ?>
                                            <td align="center">
                                            </td>
                                            <td align="center">
                                            </td>
                                    <?php
                                        }
                                    ?>

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
}



