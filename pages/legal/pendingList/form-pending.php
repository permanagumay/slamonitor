<?php
include "assets/koneksi.php";
session_start();
if(isset($_SESSION['nik']) && isset($_SESSION['id_cabang'])) {
    $idCabang = $_SESSION['id_cabang'];
    $sql = mysqli_query($Open, "select a.id_crm,a.cif, a.ppk, a.crm, b.status_progress, a.create_at, a.nama_debitur, a.keterangan  
                                      from tb_inputcrm a 
                                      left join master_statusaplikasi b on a.status = b.id_progress
                                      left join cabang c on a.cabang = c.company_name
                                      where a.status = 3 and c.id_cabang = '$idCabang' order by a.create_at DESC ");
?>
    <ul class="breadcrumb">
        <li class="active">List Pending</li>
    </ul>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <table id="tableCRM1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Nama Debitur</th>
                                <th style="text-align: center">No. CIF</th>
                                <th style="text-align: center">No. PPK</th>
                                <th style="text-align: center">No. CRM</th>
                                <th style="text-align: center">Tgl. Create</th>
                                <th style="text-align: center">Status-Aplikasi</th>
                                <th style="text-align: center">Keterangan</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 0;
                            while($row = mysqli_fetch_array($sql)){
                                /*$tglCreate = date_create($row[5]);
                                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                                $dtNow =  strtotime(date("Y-m-d"));
                                $selisih = abs($dtNow-$dtCreate);
                                $sla = $selisih/86400; // 86400 jumlah detik dalam sehari*/
                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$no+1?></td>
                                    <td><?=$row[6]?></td>
                                    <td><?=$row[1]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[5]?></td>
                                    <td style="text-align: center"><?=$row[4]?></td>
                                    <td style="text-align: center"><?=$row[7]?></td>
                                    <!--<td style="text-align: center"><?/*=$sla*/?></td>-->
                                    <td align="center">
                                        <a href="pages/legal/createDebitur/form-update-debitur.php?&idCrm=<?=$row[0];?>"
                                           data-toggle="modal" data-target="#modalUpdateDebitur"
                                           title="Update Debitur"> <i class="fa  fa-unlock"></i>
                                        </a>
                                        <a href="home-legal.php?page=form-detail&idCrm=<?=$row[0]?>" title="Detail">
                                            <i class="fa  fa-windows"></i>
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
        <!-- Start Modal Update Debitur -->
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalUpdateDebitur"
             role="dialog">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        <!-- End Modal Update Debitur -->

    </section>
    <script type="text/javascript">
        $(function () {
            $("#tableCRM1").DataTable();
            $('#tableCRM2').DataTable({
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


