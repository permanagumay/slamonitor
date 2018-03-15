<?php
include_once "assets/koneksi.php";
session_start();
if(isset($_SESSION['nik'])){
    $sql = mysqli_query($Open, "select
                                        a.id_marketing
                                        ,b.company_name
                                        ,a.nama_marketing
                                        ,a.nik_marketing
                                        ,a.code_ho
                                        ,a.aktif                             
                                      from master_marketing a 
                                      left join cabang b on a.id_cabang = b.id_cabang");
    ?>
    <ul class="breadcrumb">
        <li class="active">List Marketing</li>
    </ul>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalMarketing">
                        Tambah Marketing.
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
                                <th style="text-align: center">AO-Code</th>
                                <th style="text-align: center">Status-Aktif</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no = 0;
                            while($row = mysqli_fetch_array($sql)){

                                if($row[5] == 'Y'){
                                    $statusAktif = 'Aktif';
                                }else {
                                    $statusAktif = 'Tidak Aktif';
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$no+1?></td>
                                    <td><?=$row[1]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[4]?></td>
                                    <td><?=$statusAktif?></td>
                                    <td align="center">
                                        <a href="pages/pusat/marketing/update-marketing.php?&idMarketing=<?=$row[0];?>" data-toggle="modal" data-target="#modalUpdateMarketing" title="Update">
                                            <i class="fa  fa-unlock"></i>
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
        <div class="modal fade" id="modalMarketing" data-keyboard="false" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ccccff">
                        <h4><b>Input Marketing</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="statusLegalMsg"></p>
                                <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-marketing">
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
                                                    <input type="text" id="nik-marketing" name="nik-marketing" class="form-control" placeholder="nik" maxlength="8">
                                                    <p class="statusNikMsg"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label" style="text-align: left">Nama</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="nama-marketing" name="nama-marketing" class="form-control" placeholder="nama">
                                                    <p class="statusNamaMsg"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label" style="text-align: left">Code-AO</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="code-ho" name="code-ho" class="form-control" placeholder="code-ao">
                                                    <p class="statusCodeHoMsg"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-yahoo pull-right submitMarketing" onclick="sentMarketing()">
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
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalUpdateMarketing" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        <!-- End Modal Update Legal -->
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

        function sentMarketing() {
            if($('#nik-marketing').val().trim() == ''){
                $('.statusNikMsg').html('<span style="color:red;">NIK wajib di isi.</span>');
                $('#nik-marketing').focus();
                return false;
            }else {
                $('.statusNikMsg').html('<span style="color:red;"></span>');
            }

            if($('#nama-marketing').val().trim() == ''){
                $('.statusNamaMsg').html('<span style="color:red;">Nama wajib di isi.</span>');
                $('#nama-marketing').focus();
                return false;
            }else {
                $('.statusNamaMsg').html('<span style="color:red;"></span>');
            }

            if($('#code-ho').val().trim() == ''){
                $('.statusCodeHoMsg').html('<span style="color:red;">Code Ho Wajib diisi.</span>');
                $('#code-ho').focus();
                return false;
            }else {
                $('.statusCodeHoMsg').html('<span style="color:red;"></span>');
            }

            $.ajax({
                type: 'post',
                url: 'pages/pusat/marketing/act-marketing.php',
                dataType: 'html',
                data:$('#form-marketing').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.statusLegalMsg').html('<span style="color:green;">Data Marketing Telah Tersimpan.</p>');
                        $('.submitLegal').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.statusLegalMsg').html('<span style="color:red;">Data Marketing Gagal Tersimpan.</p>');
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