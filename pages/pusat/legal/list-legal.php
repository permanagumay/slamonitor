<?php
include_once "assets/koneksi.php";
session_start();
if(isset($_SESSION['nik'])){
    $sql = mysqli_query($Open, "SELECT a.id_user
                                            , a.nik
                                            , a.nama
                                            , b.company_name
                                            , a.hak_akses
                                            , a.aktif 
                                        FROM user a
                                        left join cabang b on a. id_cabang = b.id_cabang");
?>
<ul class="breadcrumb">
    <li class="active">List Legal</li>
</ul>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalLegal">
                    Tambah legal.
                </button>
            </div>
        </div>
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <table id="tableDashboard1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Cabang</th>
                                <th style="text-align: center">Nama</th>
                                <th style="text-align: center">Nik</th>
                                <th style="text-align: center">Hak Akses</th>
                                <th style="text-align: center">Status-Aktif</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no = 0;
                            while($row = mysqli_fetch_array($sql)){
                                if($row[4]== 2){
                                    $hakAkses = 'Administrator';
                                }elseif($row[4] == 3){
                                    $hakAkses = 'User';
                                }

                                if($row[5] == 'Y'){
                                    $statusAktif = 'Aktif';
                                }else {
                                    $statusAktif = 'Tidak Aktif';
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$no+1?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[1]?></td>
                                    <td><?=$hakAkses?></td>
                                    <td><?=$statusAktif?></td>
                                    <td align="center">
                                        <a href="pages/pusat/legal/update-legal.php?&idUser=<?=$row[0];?>" data-toggle="modal" data-target="#modalUpdateLegal" title="Update">
                                            <i class="fa  fa-unlock"></i>
                                        </a>
                                        <a href="pages/pusat/legal/reset-password.php?&idUser=<?=$row[0];?>" data-toggle="modal" data-target="#modalResetPassword" title="Reset Password">
                                            <i class="fa  fa-retweet"></i>
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
    <!-- Start modal Tambah Legal -->
    <div class="modal fade" id="modalLegal" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ccccff">
                    <h4><b>Input Legal</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="statusLegalMsg"></p>
                            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-legal">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" style="text-align: left">Cabang</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="selectCabang" name="selectCabang">
                                                    <?= getMasterCabang(); ?>
                                                </select>
                                                <p class="statusCabangMsg"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" style="text-align: left">Nik</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nik-legal" name="nik-legal" class="form-control" placeholder="nik" maxlength="8">
                                                <p class="statusNikMsg"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" style="text-align: left">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nama-legal" name="nama-legal" class="form-control" placeholder="nama">
                                                <p class="statusNamaMsg"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" style="text-align: left">Hak-Akses</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="selectHakAkses" name="selectHakAkses">
                                                    <option value="2">Administrator</option>
                                                    <option value="3">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yahoo pull-right submitLegal" onclick="sentLegal()">
                        Submit
                    </button>
                    <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                        Kembali/Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Modal Update Legal -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalUpdateLegal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- End Modal Update Legal -->
    <!-- Start Modal Reset Password -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalResetPassword" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- End Modal Reset Password -->
</section>
<script>
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

        function sentLegal() {
            if($('#selectHakAkses').val() == 2){
                if($('#selectCabang').val() != 1){
                    $('.statusCabangMsg').html('<span style="color:red;">Hak Akses Administrator hanya untuk Cabang PT Bank Agris.</span>');
                    return false;
                }else {
                    $('.statusCabangMsg').html('<span style="color:red;"></span>');
                }
            }

            if($('#selectHakAkses').val() == 3){
                if($('#selectCabang').val() == 1){
                    $('.statusCabangMsg').html('<span style="color:red;">Hak Akses User Tidak untuk Cabang PT Bank Agris.</span>');
                    return false;
                }else {
                    $('.statusCabangMsg').html('<span style="color:red;"></span>');
                }
            }

            if($('#nik-legal').val().trim() == ''){
                $('.statusNikMsg').html('<span style="color:red;">NIK wajib di isi.</span>');
                return false;
            }else {
                $('.statusNikMsg').html('<span style="color:red;"></span>');
            }

            if($('#nama-legal').val().trim() == ''){
                $('.statusNamaMsg').html('<span style="color:red;">Nama wajib di isi.</span>');
                return false;
            }else {
                $('.statusNamaMsg').html('<span style="color:red;"></span>');
            }

            $.ajax({
                type: 'post',
                url: 'pages/pusat/legal/act-legal.php',
                dataType: 'html',
                data:$('#form-legal').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.statusLegalMsg').html('<span style="color:green;">Data Legal Telah Tersimpan.</p>');
                        $('.submitLegal').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.statusLegalMsg').html('<span style="color:red;">Data Legal Gagal Tersimpan.</p>');
                    }else if (msg == 'nik') {
                        $('.statusLegalMsg').html('<span style="color:red;">NIK Sudah Tedaftar.</p>');
                    } else {
                        $('.statusLegalMsg').html('<span style="color:red;">Data Error.</p>');
                    }
                }
            });

        }


</script>
<?php
}else {
    echo "Data Error";
}