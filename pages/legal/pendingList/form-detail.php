<?php
require_once "assets/koneksi.php";
if (isset($_SESSION['nik'])) {
    $nik = $_SESSION['nik'];
    if (isset($_GET['idCrm'])) {

        $idCrm = $_GET['idCrm'];
        $sql = mysqli_query($Open, "select a.cabang,c.nama_marketing,a.nama_debitur, a.cif, a.ppk, a.crm, a.tgl_terimacrm, a.keterangan, d.status_progress
                                           from tb_inputcrm a 
                                           left join master_marketing c on c.nik_marketing = a.nik_marketing
                                           left join master_statusaplikasi d on a.status = d.id_progress
                                           where a.id_crm = '$idCrm' ");
        $result = mysqli_fetch_array($sql);
        ?>
        <div class="box box-body">
            <div class="content">
                <ul class="breadcrumb">
                    <li class="active">Detail Debitur</li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Cabang</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[0] ?>" name="cabang" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Marketing</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[1] ?>" name="nama_marketing" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Nama Debitur</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[2] ?>" name="nama_debitur" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Tgl. Terima
                                        CRM</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[6] ?>" name="tgl_terimaCrm" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">CIF</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[3] ?>" name="nomor_cif" id="nomor_cif" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">No. PPK</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[4] ?>" name="nomor_ppk" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">No. CRM</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[5] ?>" name="nomor_crm" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Status Aplikasi</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" value="<?= $result[8] ?>" name="status_aplikasi" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align: left">Keterangan</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" readonly="readonly"><?= $result[7] ?></textarea>
                                        <input type="hidden" id="id_Crm" value="<?= $idCrm ?>">
                                    </div>
                                    <button type="button" class="btn btn-yahoo pull-right submitKPBtn" onclick="sentKPForm()">
                                        Sent to Kantor Pusat
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="content-headers">
                    <ul class="nav nav-tabs navTabs">
                        <li><a data-toggle="tab" href="#agunan">Agunan</a></li>
                        <li><a data-toggle="tab" href="#fasilitas">Fasilitas</a></li>
                        <li><a data-toggle="tab" href="#covernote">Covernote</a></li>
                        <li><a data-toggle="tab" href="#covenant">Covenant</a></li>
                        <li><a data-toggle="tab" href="#docTbo">Document TBO</a></li>
                        <li><a data-toggle="tab" href="#deviasi">Deviasi</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">List Asuransi
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a data-toggle="tab" href="#asuransiJaminan">Asuransi Jaminan</a></li>
                                <li><a data-toggle="tab" href="#asuransiFasilitas">Asuransi Lain</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="agunan" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalAgunan">
                                        Tambah Agunan.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Agunan</th>
                                                <th style="text-align: center">Agunan Lain</th>
                                                <th style="text-align: center">Alamat/Lokasi</th>
                                                <th style="text-align: center">No. Certificate/Jaminan</th>
                                                <th style="text-align: center">Due Date (HGB)</th>
                                                <th style="text-align: center">Pengikatan</th>
                                                <th style="text-align: center">Nilai Jaminan</th>
                                                <th style="text-align: center">Tgl. Penyelesaian</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $sqlAgunan = mysqli_query($Open, "select 
                                                                                            a.id_agunan
                                                                                            ,b.jenis_agunan
                                                                                            ,a.alamat
                                                                                            ,a.no_certificate
                                                                                            ,duedate_hgb
                                                                                            ,c.jenis_pengikatanagunan
                                                                                            ,d.status_progress
                                                                                            ,a.nilai_penjaminan
                                                                                            ,a.create_at
                                                                                            ,a.jaminan_lain
                                                                                            ,a.tgl_penyelesaian
                                                                                            from tb_inputjaminan a
                                                                                            left join master_jenisagunan b on b.id_jenisagunan = a.jaminan
                                                                                            left join master_jenispengikatanagunan c on c.id_jenispengikatanagunan = a.pengikatan
                                                                                            left join master_statusprogress d on d.id_progress = a.status
                                                                                       where a.id_crm = '$idCrm' order by a.create_at DESC ");

                                            $no = 0;
                                            while ($rowAgunan = mysqli_fetch_array($sqlAgunan)) {                                              

                                               if($rowAgunan[7] == 0){
                                                   $nilai = '';
                                               }else {
                                                   $nilai = $rowAgunan[7];
                                               }
											   
											   // cek id_agunan di tb_inputasuransi tidak boleh lebih dari 1
                                                $sqlCekIdAgunanDiAsuransi = mysqli_query($Open, "select id_agunan from tb_inputasuransi where id_agunan = '".$rowAgunan[0]."'");
                                                $resultIdAgunanDiAsuransi = mysqli_num_rows($sqlCekIdAgunanDiAsuransi);
                                            ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowAgunan[1] ?></td>
                                                    <td><?= $rowAgunan[9] ?></td>
                                                    <td><?= $rowAgunan[2] ?></td>
                                                    <td><?= $rowAgunan[3] ?></td>
                                                    <td><?= $rowAgunan[4] ?></td>
                                                    <td><?= $rowAgunan[5] ?></td>
                                                    <td><?= $nilai ?></td>
                                                    <td><?= $rowAgunan[10] ?></td>
                                                    <td><?= $rowAgunan[6] ?></td>
                                                    <td align="center">
                                                        <?php
                                                        if($resultIdAgunanDiAsuransi >= 1){
                                                            ?>
                                                            <a href="pages/legal/pendingList/form-updateagunan.php?&idAgunan=<?= $rowAgunan[0] ?>"
                                                               data-toggle="modal" data-target="#modalUpdateAgunan"
                                                               title="Update"><i class="fa  fa-unlock"></i>
                                                            </a>
                                                            <?php
                                                        }else {
                                                            ?>
                                                            <a href="pages/legal/pendingList/form-updateagunan.php?&idAgunan=<?= $rowAgunan[0] ?>"
                                                               data-toggle="modal" data-target="#modalUpdateAgunan"
                                                               title="Update"><i class="fa  fa-unlock"></i>
                                                            </a>
                                                            <a href="pages/legal/pendingList/form-asuransi.php?&idAgunan=<?= $rowAgunan[0] ?>"
                                                               data-toggle="modal" data-target="#modalAsuransi"
                                                               title="Asuransi"><i class="fa  fa-ambulance"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
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
                        <!-- Start Modal Asuransi -->
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalAsuransi" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Asuransi -->
                        <!-- Start Modal Agunan -->
                        <div class="modal fade" id="modalAgunan" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Agunan</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="statusMsg"></p>
                                                <form role="form" action="#" id="form-agunan" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Agunan</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectAgunan" name="selectAgunan" onchange="showAgunanLainnya()">
                                                                        <?=getMasterAgunan(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divAgunanLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="agunanLainnya" name="agunanLainnya" placeholder="lainnya">
                                                                    <p class="statusAgunanLain"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                                                <div class="col-sm-8">
                                                                    <textarea class="form-control" id="alamatLokasi" name="alamatLokasi" placeholder="alamat/lokasi"></textarea>
                                                                    <p class="statusAlamatAgunan"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">No.Certificate/Jaminan</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="no_sertificate" name="no_sertificate" placeholder="no. certificate/jaminan">
                                                                    <p class="statusNoSertificateAgunan"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglHgb">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Due Date (HGB)</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerDueDate">
                                                                        <input class="form-control" id="duedate" name="duedate" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="statusDueDate"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Nama Pemilik/Penjamin</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="nama pemilik/penjamin">
                                                                    <p class="statusNamaPemilikAgunan"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Pengikatan</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectPengikatan" name="selectPengikatan" onchange="showPengikatanLainnya()">
                                                                        <?=getMasterPengikatan(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divPengikatanLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="pengikatanLainnya" name="pengikatanLainnya" placeholder="pengikatan lainnya">
                                                                    <p class="statusPengikatanLain"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">No. Akta Pengikatan</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="nomorAkta" name="nomorAkta" placeholder="no. akta pengikatan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Nilai Penjaminan</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="nilaiJaminan" name="nilaiJaminan" onkeyup="validAngka(this);" placeholder="nilai penjaminan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">Tgl.Pengurusan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date"
                                                                         id="datePickerPengurusan">
                                                                        <input class="form-control" id="tglPengurusan" name="tglPengurusan" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTarget">
                                                                        <input class="form-control" id="tglTarget" name="tglTarget" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Masuk Khasanah</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerKhasanah">
                                                                        <input class="form-control" id="tglKhasanah" name="tglKhasanah" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <input type="hidden" name="id_crm" value="<?=$idCrm?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitBtn" onclick="sentAgunanForm()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                                            Kembali/Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Agunan-->
                        <!-- Start Modal Update Agunan -->
                        <div class="modal fade" id="modalUpdateAgunan" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Agunan -->
                    </div>
                    <div id="fasilitas" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalFasilitas">
                                        Tambah Fasilitas.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="tableFasilitas1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Jaminan</th>
                                                <th style="text-align: center">Pemilik Jaminan</th>
                                                <th style="text-align: center">Alamat Jaminan</th>
                                                <th style="text-align: center">Fasilitas</th>
                                                <th style="text-align: center">Code Fasilitas</th>
                                                <th style="text-align: center">Plafond</th>
                                                <th style="text-align: center">Tipe Plafond</th>
                                                <th style="text-align: center">Tipe Plafond Lain</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlFasilitas = mysqli_query($Open, "select 
                                                                                    b.id_inputfasilitas
                                                                                    ,a.jaminan
                                                                                    ,c.jenis_agunan
                                                                                    ,e.fasilitas
                                                                                    ,b.fascode
                                                                                    ,b.plafond
                                                                                    ,d.tipe_kredit
                                                                                    ,b.tipkreditlain
                                                                                    ,a.nama_pemilik
                                                                                    ,a.alamat
                                                                                    from tb_inputjaminan a
                                                                                    inner join tb_inputfasilitas b on a.id_agunan = b.id_agunan
                                                                                    left join master_jenisagunan c on a.jaminan = c.id_jenisagunan
                                                                                    left join master_tipekredit d on b.id_tipkredit = d.id_tipekredit
                                                                                    left join master_fasilitas e on b.jenis_fasilitas = e.id_fasilitas
                                                                                    where a.id_crm = '$idCrm' order by b.create_at ASC ");

                                            $no = 0;
                                            while ($rowFasilitas = mysqli_fetch_array($sqlFasilitas)) {
												// cek asuransi fasilitas tidak boleh lebih dari satu
                                                $sqlCekIdFasilitas = mysqli_query($Open, "select id_inputfasilitas from tb_inputasuransifasilitas where id_inputfasilitas = '".$rowFasilitas[0]."' ");
                                                $resultAsuransiFasilitas = mysqli_num_rows($sqlCekIdFasilitas);
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowFasilitas[2] ?></td>
                                                    <td><?= $rowFasilitas[8] ?></td>
                                                    <td><?= $rowFasilitas[9] ?></td>
                                                    <td><?= $rowFasilitas[3] ?></td>
                                                    <td><?= $rowFasilitas[4] ?></td>
                                                    <td><?= $rowFasilitas[5] ?></td>
                                                    <td><?= $rowFasilitas[6] ?></td>
                                                    <td><?= $rowFasilitas[7] ?></td>
                                                    <td align="center">
                                                        <?php
                                                            if($resultAsuransiFasilitas >= 1){
                                                        ?>
                                                                <a href="pages/legal/pendingList/form-updatefasilitas.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                                   data-toggle="modal" data-target="#modalUpdateFas"
                                                                   title="Update">
                                                                    <i class="fa  fa-unlock"></i>
                                                                </a>
                                                                <a href="pages/legal/pendingList/form-penarikan.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                                   data-toggle="modal" data-target="#modalPenarikan"
                                                                   title="Update Penarikan"><i class="fa  fa-underline"></i>
                                                                </a>
                                                        <?php
                                                            }else {
                                                        ?>
                                                                <a href="pages/legal/pendingList/form-updatefasilitas.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                                   data-toggle="modal" data-target="#modalUpdateFas"
                                                                   title="Update">
                                                                    <i class="fa  fa-unlock"></i>
                                                                </a>
                                                                <a href="pages/legal/pendingList/form-asuransifasilitas.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                                   data-toggle="modal" data-target="#modalAsuransiFasilitas"
                                                                   title="Asuransi"><i class="fa  fa-ambulance"></i>
                                                                </a>
                                                                <a href="pages/legal/pendingList/form-penarikan.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                                   data-toggle="modal" data-target="#modalPenarikan"
                                                                   title="Update Penarikan"><i class="fa  fa-underline"></i>
                                                                </a>
                                                        <?php
                                                            }
                                                        ?>
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
                        <!-- Start Modal Fasilitas -->
                        <div class="modal fade" id="modalFasilitas" data-keyboard="false" data-backdrop="static"
                             role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Fasilitas</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="statusFasilitasMsg"></p>
                                                <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-fasilitas">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Agunan Tersedia</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectAgunanFas" name="selectAgunanFas">
                                                                        <?= getJaminanByIdCrm($idCrm); ?>
                                                                    </select>
                                                                    <p class="statusPilihanJamininanMsg"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tipe Plafond</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="tipePlafond" name="tipePlafond" onchange="showTipePlafondLainnya()">
                                                                        <?= getTipeKredit(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTipeLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="tipeLainnya" name="tipeLainnya" placeholder="tipe lainnya"/>
                                                                    <p class="statusTipeLain"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Fasilitas</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectFasilitas" name="selectFasilitas" onchange="selectFasilitasToGetFasCode()">
                                                                        <?= getMasterFasilitas() ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-4">
                                                                    <input class="form-control" id="codeFasilitas" name="codeFasilitas" readonly="readonly"/>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input class="form-control" id="SeqFasilitas" name="SeqFasilitas" placeholder="seq. number facilites" onkeyup="validAngka(this)"/>
                                                                    <p class="statusSeqFasilitas"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Plafond Fasilitas</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="plafondFas" name="plafondFas" onkeyup="validAngka(this)"/>
                                                                    <p class="statusPlafFasilitas"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Cara Penarikan</label>
                                                                <div class="col-sm-8" id="penarikanGroup">
                                                                    <div class="input-group control-group">
                                                                    <textarea id="caraPenarikan" rows="6" name="caraPenarikan[]" class="form-control" placeholder="cara penarikan"></textarea>
                                                                        <div class="input-group-btn">
                                                                            <button class="btn btn-success" id="add_more" type="button">
                                                                                <i class="glyphicon glyphicon-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <p class="statusCaraPenarikanFas"></p>
                                                                    <input type="hidden" id="idCrmFas" name="idCrmFas" value="<?= $idCrm ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitFasBtn" onclick="sentFasilitas()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                                            Kembali/Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Fasilitas-->
                        <!-- Start Modal Update Fasilitas -->
                        <div class="modal fade" id="modalUpdateFas" data-keyboard="false" data-backdrop="static"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Fasilitas -->
                        <!-- Start Modal Update Penarikan -->
                        <div class="modal fade" id="modalPenarikan" data-keyboard="false" data-backdrop="static"
                             role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Penarikan -->
                        <!-- Start Modal Asuransi Fasilitas -->
                        <div class="modal fade" id="modalAsuransiFasilitas" data-keyboard="false" data-backdrop="static"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Asuransi Fasilitas -->
                    </div>
                    <div id="covernote" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalCoverNote">
                                        Tambah Covernote.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="tableCovNote1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Tgl. Pengikatan</th>
                                                <th style="text-align: center">Jenis Pengikatan</th>
                                                <th style="text-align: center">Nama Notaris</th>
                                                <th style="text-align: center">No. Covernote</th>
                                                <th style="text-align: center">Tgl. Target</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlCovNote = mysqli_query($Open, "SELECT a.id_inputcovertnote
                                                                                      ,a.tgl_pengikatancovernote
                                                                                      ,b.pengikatan
                                                                                      ,a.nama_notaris
                                                                                      ,a.no_covernote
                                                                                      ,a.tgl_covernote`id_inputcovertnote`
                                                                                FROM `tb_inputcovernote` a
                                                                                left join master_pengikatan b on a.jenis_pengikatancovernote = b.id_pengikatan
                                                                                where a.id_crm = '$idCrm'");

                                            $no = 0;
                                            while ($rowCovNote = mysqli_fetch_array($sqlCovNote)) {
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowCovNote[1] ?></td>
                                                    <td><?= $rowCovNote[2] ?></td>
                                                    <td><?= $rowCovNote[3] ?></td>
                                                    <td><?= $rowCovNote[4] ?></td>
                                                    <td><?= $rowCovNote[5] ?></td>
                                                    <td align="center">
                                                        <a href="pages/legal/pendingList/form-updatecovernote.php?&id_inputcovnote=<?= $rowCovNote[0] ?>"
                                                           data-toggle="modal" data-target="#modalUpdateCoveNote"
                                                           title="Update">
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
                        <!-- Start Modal Covernote -->
                        <div class="modal fade" id="modalCoverNote" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Covernote</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="statusCovernoteMSG"></p>
                                                <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-covernote">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengikatan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date"
                                                                         id="datePickerPengikatan">
                                                                        <input class="form-control" id="tglPengikatan"
                                                                               name="tglPengikatanCovernote"
                                                                               placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span
                                                                                    class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="statusTglPengikatan"></p>
                                                                </div>
                                                                <input type="hidden" id="idCrmCovNote" name="idCrmCovNote" value="<?= $idCrm ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">Jenis Pengikatan</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control"
                                                                            id="selectPengikatanNotaris"
                                                                            name="selectPengikatanNotaris" onchange="showNotaris();">
                                                                        <?= getMasterPengikatanNotaris(); ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divNamaNotaris">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">Nama Notaris</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="namaNotaris"
                                                                           name="namaNotaris"
                                                                           placeholder="nama notaris">
                                                                    <p class="statusNamaNotaris"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">No. Covernote</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="noCovernote"
                                                                           name="noCovernote"
                                                                           placeholder="no. covernotes">
                                                                    <p class="statusNoCovernote"></p>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">Tgl. Target</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date"
                                                                         id="datePickerCovernote">
                                                                        <input class="form-control" id="tglCovernote"
                                                                               name="tglCovernote"
                                                                               placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span
                                                                                    class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="statusTglCovernote"></p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitCovernote"
                                                onclick="sentCovernote()">Submit
                                        </button>
                                        <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                                                onclick="window.location.reload()">Kembali/Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Covernote -->

                        <!-- Start Modal Update Covernote -->
                        <div class="modal fade" id="modalUpdateCoveNote" data-keyboard="false" data-backdrop="static"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Covernote -->
                    </div>
                    <div id="covenant" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalCovenant">
                                        Tambah Covenant.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="tableCovenant1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Syarat/Kewajiban</th>
                                                <th style="text-align: center">Syarat Lain</th>
                                                <th style="text-align: center">Tgl. Mulai</th>
                                                <th style="text-align: center">Tgl. Target</th>
                                                <th style="text-align: center">Tgl. Pemenuhan</th>
                                                <th style="text-align: center">Status Progress</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $sqlCovenant = mysqli_query($Open, "SELECT a.id_input_covenant
                                                                                            ,b.syarat
                                                                                            , a.syarat_lainnya
                                                                                            , a.tgl_mulai
                                                                                            , a.tgl_target
                                                                                            , a.tgl_pemenuhan
                                                                                            , c.status_progress
                                                                                      FROM tb_inputcovenant a
                                                                                      left join master_syaratcovenant b on a.id_syarat = b.id_syarat
                                                                                      left join master_statusprogress c on a.status_progress = c.id_progress
                                                                                      where a.id_crm = '$idCrm' order by a.create_at DESC ");
                                            $no = 0;
                                            while ($rowCovenant = mysqli_fetch_array($sqlCovenant)) {
                                                if($rowCovenant[5] == '0000-00-00'){
                                                    $tglPemenuhan = '';
                                                }else{
                                                    $tglPemenuhan = $rowCovenant[5];
                                                }
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowCovenant[1] ?></td>
                                                    <td><?= $rowCovenant[2] ?></td>
                                                    <td><?= $rowCovenant[3] ?></td>
                                                    <td><?= $rowCovenant[4] ?></td>
                                                    <td><?= $tglPemenuhan ?></td>
                                                    <td><?= $rowCovenant[6] ?></td>
                                                    <td align="center">
                                                        <a href="pages/legal/pendingList/form-updatecovenant.php?&idInputCovenant=<?= $rowCovenant[0] ?>"
                                                           data-toggle="modal" data-target="#modalUpdateCovenant"
                                                           title="Update">
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
                        <!-- Start Modal Covenant -->
                        <div class="modal fade" id="modalCovenant" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Covenant</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form role="form" action="#" id="form-covenant" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <p class="covenantStatus"></p>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Syarat/Kewajiban</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectCovenant" name="selectCovenant" onchange="showCovenantLainnya()">
                                                                        <?= getMasterCovenantCombo(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divCovenantLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <textarea class="form-control" id="covenantLainnya" name="covenantLainnya" placeholder="covenant lainnya"></textarea>
                                                                    <p class="covenantLainnyaStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglMulaiCovenant">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Mulai</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglMulaiCovenant">
                                                                        <input class="form-control" id="TglMulaiCovenant" name="TglMulaiCovenant" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="tglMulaiCovStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglTargetCovenant">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglTargetCovenant">
                                                                        <input class="form-control" id="TglTargetCovenant" name="TglTargetCovenant" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="tglTargetCovStatus"></p>
                                                                    <input type="hidden" name="idCrm" value="<?=$idCrm?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitCovenantBtn" onclick="sentCovenantForm()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                                            Kembali/Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Covenant -->
                        </div>
                        <!-- End Modal Covenant -->
                        <!-- Start Modal Update Covenant -->
                        <div class="modal fade" id="modalUpdateCovenant" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                            <!-- End Modal Covenant -->
                        </div>
                        <!-- End Modal Update Covenant -->
                    </div>
                    <div id="docTbo" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalDocTbo">
                                        Tambah Dokumen.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="tableDoc1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Jenis Document</th>
                                                <th style="text-align: center">Document Lain</th>
                                                <th style="text-align: center">Tgl. Pengurusan</th>
                                                <th style="text-align: center">Tgl. Target</th>
                                                <th style="text-align: center">Tgl. Pemenuhan</th>
                                                <th style="text-align: center">Status Progress</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $sqlDoc = mysqli_query($Open, "SELECT a.id_inputdoc
                                                                                            , b.document
                                                                                            , a.doc_lain
                                                                                            , a.tgl_pengurusan
                                                                                            , a.tgl_target
                                                                                            , a.tgl_pemenuhan
                                                                                            , c.status_progress
                                                                                    FROM `tb_inputdoc` a
                                                                                    left join master_document b on a.id_doc = b. id_masterdoc
                                                                                    left join master_statusprogress c on a.status = c.id_progress
                                                                                    WHERE a.id_crm = '$idCrm' order by a.create_at DESC ");
                                            $no = 0;
                                            while ($rowDoc = mysqli_fetch_array($sqlDoc)) {
                                                if($rowDoc[5] == '0000-00-00' ){
                                                    $tglPemenuhanDoc = '';
                                                }else {
                                                    $tglPemenuhanDoc = $rowDoc[5];
                                                }
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowDoc[1] ?></td>
                                                    <td><?= $rowDoc[2] ?></td>
                                                    <td><?= $rowDoc[3] ?></td>
                                                    <td><?= $rowDoc[4] ?></td>
                                                    <td><?= $tglPemenuhanDoc ?></td>
                                                    <td><?= $rowDoc[6] ?></td>
                                                    <td align="center">
                                                        <a href="pages/legal/pendingList/form-updatedoc.php?&id_inputdoc=<?= $rowDoc[0] ?>"
                                                           data-toggle="modal" data-target="#modalUpdateDocument"
                                                           title="Update">
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
                        <!-- Start Modal Document -->
                        <div class="modal fade" id="modalDocTbo" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Document TBO</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="documentStatusMsg"></p>
                                                <form role="form" action="#" class="form-horizontal"  id="form-document" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Document</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectDocument" name="selectDocument" onchange="showDocumentLainnya()">
                                                                        <?=getDokument(); ?>
                                                                    </select>
                                                                    <input type="hidden" id="idCrmDoc" name="idCrmDoc" value="<?= $idCrm ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divDocumentLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="docLainnya" name="docLainnya" placeholder="document lainnya">
                                                                    <p class="docLainnyaStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglMulaiDoc">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengurusan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglMulaiDoc">
                                                                        <input class="form-control" id="TglMulaiDoc" name="TglMulaiDoc" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="tglMulaiDocStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglTargetDoc">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglTargetDoc">
                                                                        <input class="form-control" id="TglTargetDoc" name="TglTargetDoc" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="tglTargetDocStatus"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitDocumentBtn" onclick="sentDocumentForm()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-facebook pull-right"  onclick="window.location.reload()">
                                            Kembali/Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Document -->
                        <!-- Start Modal Update Document -->
                        <div class="modal fade" id="modalUpdateDocument" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Document -->
                    </div>
                    <div id="deviasi" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalDeviasi">
                                        Tambah Deviasi.
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table id="tableDeviasi1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Deviasi</th>
                                                <th style="text-align: center">Deviasi Lain</th>
                                                <th style="text-align: center">Tgl. Mulai</th>
                                                <th style="text-align: center">Tgl. Target</th>
                                                <th style="text-align: center">Tgl. Pemenuhan</th>
                                                <th style="text-align: center">Keterangan</th>
                                                <th style="text-align: center">Status Progress</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $sqlDeviasi = mysqli_query($Open, "SELECT a.id_crm
                                                                                    ,a.id_inputdeviasi
                                                                                    ,b.deviasi
                                                                                    ,a.deviasi_lain
                                                                                    ,a.tgl_mulai
                                                                                    ,a.tgl_target
                                                                                    ,a.tgl_pemenuhan
                                                                                    ,a.keterangan
                                                                                    ,c.status_progress  
                                                                                FROM tb_inputdeviasi a
                                                                                left join master_deviasi b on a.id_deviasi = b.id_masterdeviasi
                                                                                left join master_statusprogress c on a.status_progress = c.id_progress
                                                                                WHERE a.id_crm = '$idCrm' order by a.create_at DESC ");
                                            $no = 0;
                                            while ($rowDeviasi = mysqli_fetch_array($sqlDeviasi)) {
                                                if($rowDeviasi[6] == '0000-00-00'){
                                                   $tglPemenuhanDev = '';
                                                }else {
                                                    $tglPemenuhanDev = $rowDeviasi[6] ;
                                                }
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"><?= $no + 1 ?></td>
                                                    <td><?= $rowDeviasi[2] ?></td>
                                                    <td><?= $rowDeviasi[3] ?></td>
                                                    <td><?= $rowDeviasi[4] ?></td>
                                                    <td><?= $rowDeviasi[5] ?></td>
                                                    <td><?= $tglPemenuhanDev ?></td>
                                                    <td><?= $rowDeviasi[7] ?></td>
                                                    <td><?= $rowDeviasi[8] ?></td>
                                                    <td align="center">
                                                        <a href="pages/legal/pendingList/form-updatedeviasi.php?&id_inputdeviasi=<?= $rowDeviasi[1] ?>&idCrm=<?= $idCrm ?>"
                                                           data-toggle="modal" data-target="#modalUpdateDeviasi"
                                                           title="Update">
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
                        <!-- Start Modal Deviasi -->
                        <div class="modal fade" id="modalDeviasi" data-keyboard="false" data-backdrop="static" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ccccff">
                                        <h4><b>Input Deviasi</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form role="form" action="#" class="form-horizontal" id="form-deviasi-detail" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="col-md-12">
                                                            <p class="deviasiStatus"></p>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Deviasi</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" id="selectDeviasi" name="selectDeviasi" onchange="showDeviasiLainnya()">
                                                                        <?php echo getMasterDeviasiCombo(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divDeviasiLainnya">
                                                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" id="deviasiLainnya" name="deviasiLainnya" placeholder="deviasi lainnya">
                                                                    <p class="deviasiLainnyaStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglMulaiDeviasi">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Mulai</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglMulaiDeviasi">
                                                                        <input class="form-control" id="TglMulaiDeviasi" name="TglMulaiDeviasi" placeholder="yyyy/mm/dd"/>
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="deviasiTglMulaiStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="divTglTargetDeviasi">
                                                                <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group input-append date" id="datePickerTglTargetDeviasi">
                                                                        <input class="form-control" id="TglTargetDeviasi" name="TglTargetDeviasi" placeholder="yyyy/mm/dd" />
                                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                    <p class="deviasiTglTargetStatus"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       style="text-align: left">Keterangan</label>
                                                                <div class="col-sm-8">
                                                                    <textarea class="form-control" id="keteranganDeviasi" name="keteranganDeviasi" placeholder="keterangan"></textarea>
                                                                    <p class="deviasiKeteranganStatus"></p>
                                                                    <input type="hidden" name="id_crmDev" value="<?=$idCrm?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-yahoo pull-right submitDeviasiBtn"
                                                onclick="sentDeviasiForm()">Submit
                                        </button>
                                        <button type="button" id="btnKembaliDeviasi"
                                                class="btn btn-facebook pull-right submitDeviasiKembali"
                                                onclick="window.location.reload()">Kembali/Cancel
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- End Modal Deviasi -->
                        <!-- Start Modal Update Deviasi -->
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalUpdateDeviasi"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Deviasi -->
                    </div>
                    <div id="asuransiJaminan" class="tab-pane fade">
                        <ul class="breadcrumb">
                            <li class="active">Detail Asuransi Jaminan</li>
                        </ul>
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-body">
                                    <table id="tableAsuransi1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">No.</th>
                                            <th style="text-align: center">Jenis Agunan</th>
                                            <th style="text-align: center">No. Sertifikat</th>
                                            <th style="text-align: center">Nama Pemilik</th>
                                            <th style="text-align: center">Jenis Asuransi</th>
                                            <th style="text-align: center">Objek Asuransi</th>
                                            <th style="text-align: center">Alamat</th>
                                            <th style="text-align: center">Nilai Pertanggungan</th>
                                            <th style="text-align: center">Asuransi</th>
                                            <th style="text-align: center">Polis</th>
                                            <th style="text-align: center">Start Date Polis</th>
                                            <th style="text-align: center">End Date Polis</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sqlAsuransi = mysqli_query($Open, "select e.jenis_agunan 
                                                                                          ,a.no_certificate
                                                                                          ,a.nama_pemilik
                                                                                          ,c.jenis_asuransi
                                                                                          ,d.objek_asuransi
                                                                                          ,b.alamat
                                                                                          ,b.nilai_pertanggungan
                                                                                          ,b.nama_asuransi
                                                                                          ,b.polis
                                                                                          ,b.start_date
                                                                                          ,b.end_date
                                                                                          ,b.id_asuransi
                                                                                    from 
                                                                                    tb_inputjaminan a 
                                                                                    inner join tb_inputasuransi b on a.id_agunan = b.id_agunan
                                                                                    left join master_jenisasuransi c on c.id_jenisasuransi = b.jenis_asuransi
                                                                                    left join master_objekasuransi d on d.id_objekasuransi = b.objek_asuransi
                                                                                    left join master_jenisagunan e on e.id_jenisagunan = a.jaminan
                                                                                    where a.id_crm = '$idCrm' ");

                                        $no = 0;
                                        while ($rowAsuransi = mysqli_fetch_array($sqlAsuransi)) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center"><?= $no + 1 ?></td>
                                                <td><?= $rowAsuransi[0] ?></td>
                                                <td><?= $rowAsuransi[1] ?></td>
                                                <td><?= $rowAsuransi[2] ?></td>
                                                <td><?= $rowAsuransi[3] ?></td>
                                                <td><?= $rowAsuransi[4] ?></td>
                                                <td><?= $rowAsuransi[5] ?></td>
                                                <td><?= $rowAsuransi[6] ?></td>
                                                <td><?= $rowAsuransi[7] ?></td>
                                                <td><?= $rowAsuransi[8] ?></td>
                                                <td><?= $rowAsuransi[9] ?></td>
                                                <td><?= $rowAsuransi[10] ?></td>
                                                <td align="center">
                                                    <a href="pages/legal/pendingList/form-asuransiJamUpdate.php?&idAsuransiJam=<?= $rowAsuransi[11] ?>"
                                                       data-toggle="modal" data-target="#modalAsuransiJamUpdate"
                                                       title="Asuransi"> <i class="fa  fa-unlock"></i>
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
                        <!-- Start Modal Asuransi Jaminan Update -->
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalAsuransiJamUpdate"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Asuransi Jaminan Update -->
                    </div>
                    <div id="asuransiFasilitas" class="tab-pane fade">
                        <ul class="breadcrumb">
                            <li class="active">Detail Asuransi Fasilitas</li>
                        </ul>
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-body">
                                    <table id="tableAsuransiFas1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">No.</th>
                                            <th style="text-align: center">Fasilitas</th>
                                            <th style="text-align: center">Plafond</th>
                                            <th style="text-align: center">Jenis Asuransi</th>
                                            <th style="text-align: center">Objek Asuransi</th>
                                            <th style="text-align: center">Alamat</th>
                                            <th style="text-align: center">Nilai Pertanggungan</th>
                                            <th style="text-align: center">Asuransi</th>
                                            <th style="text-align: center">Polis</th>
                                            <th style="text-align: center">Start Date Polis</th>
                                            <th style="text-align: center">End Date Polis</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sqlAsuransiFas = mysqli_query($Open, "SELECT a.id_asuransi
                                                                                        , c.fasilitas
                                                                                        , b.plafond
                                                                                        , d.jenis_asuransi
                                                                                        , e.objek_asuransi
                                                                                        , a.alamat
                                                                                        , a.nilai_pertanggungan
                                                                                        , a.nama_asuransi
                                                                                        , a.polis
                                                                                        , a.start_date
                                                                                        , a.end_date                                                                                          
                                                                                FROM tb_inputasuransifasilitas a
                                                                                left join tb_inputfasilitas b on a.id_inputfasilitas = b.id_inputfasilitas
                                                                                left join master_fasilitas c on b.jenis_fasilitas = c.id_fasilitas
                                                                                left join master_jenisasuransi d on a.jenis_asuransi = d.id_jenisasuransi
                                                                                left join master_objekasuransi e on a.objek_asuransi = e.id_objekasuransi
                                                                                left join tb_inputjaminan f on b.id_agunan = f.id_agunan
                                                                                WHERE f.id_crm = '" . $idCrm . "' ");

                                        $no = 0;
                                        while ($rowAsuransiFas = mysqli_fetch_array($sqlAsuransiFas)) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center"><?= $no + 1 ?></td>
                                                <td><?= $rowAsuransiFas[1] ?></td>
                                                <td><?= $rowAsuransiFas[2] ?></td>
                                                <td><?= $rowAsuransiFas[3] ?></td>
                                                <td><?= $rowAsuransiFas[4] ?></td>
                                                <td><?= $rowAsuransiFas[5] ?></td>
                                                <td><?= $rowAsuransiFas[6] ?></td>
                                                <td><?= $rowAsuransiFas[7] ?></td>
                                                <td><?= $rowAsuransiFas[8] ?></td>
                                                <td><?= $rowAsuransiFas[9] ?></td>
                                                <td><?= $rowAsuransiFas[10] ?></td>
                                                <td align="center">
                                                    <a href="pages/legal/pendingList/form-updateasuransifas.php?&idAsuransiFas=<?= $rowAsuransiFas[0] ?>"
                                                       data-toggle="modal" data-target="#modalAsuFas"
                                                       title="Asuransi">
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
                        <!-- Start Modal Update Asuransi Fasilitas -->
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalAsuFas"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- End Modal Update Asuransi Fasilitas -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = function () {
                document.getElementById("divAgunanLainnya").style.display = 'none';
                document.getElementById("divPengikatanLainnya").style.display = 'none';
                /*document.getElementById("divTglHgb").style.display = 'none';*/
                document.getElementById("divCovenantLainnya").style.display = 'none';
                document.getElementById("divDeviasiLainnya").style.display = 'none';
                document.getElementById("divTipeLainnya").style.display = 'none';
                document.getElementById("divDocumentLainnya").style.display = 'none';
            };

            $(document).ready(function () {
                var selectAgunan = document.getElementById("selectAgunan").value;
                if (selectAgunan == 1 || selectAgunan == 2) {
                    document.getElementById("divTglHgb").style.display = '';
                } else if (selectAgunan != 1 || selectAgunan != 2) {
                    document.getElementById("divTglHgb").style.display = 'none';
                }

                selectFasilitasToGetFasCode();


                $('#datePickerDueDate').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerPengurusan').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTarget').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerPenyelesaian').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerKhasanah').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTglMulaiCovenant').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTglTargetCovenant').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTglMulaiDeviasi').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTglTargetDeviasi').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerPengikatan').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });

                $('#datePickerCovernote').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });

                $('#datePickerTglMulaiDoc').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });
                $('#datePickerTglTargetDoc').datepicker({
                    autoclose: true,
                    format: 'yyyy/mm/dd'
                });


                var i = 1;
                $('#add_more').click(function () {
                    i++;
                    $('#penarikanGroup').append('<div class="input-group control-group" id="row' + i + '" style="margin-top: 10px"><textarea id="caraPenarikan" rows="6" name="caraPenarikan[]" class="form-control"  placeholder="cara penarikan"></textarea><div class="input-group-btn"><button class="btn btn-danger btn_remove" id="' + i + '" name="remove" type="button"><i class="glyphicon glyphicon-minus"></i></button></div></div>');
                });

                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });

            function validAngka(a) {
                if (!/^[0-9.]+$/.test(a.value)) {
                    a.value = a.value.substring(0, a.value.length - 1000);
                }
            }

            function showAgunanLainnya() {
                var agunanLain = document.getElementById("selectAgunan").value;

                if (agunanLain == 19 || agunanLain == 11) {
                    document.getElementById("divAgunanLainnya").style.display = '';
                } else if (agunanLain != 19) {
                    document.getElementById("divAgunanLainnya").style.display = 'none';
                }

                if (agunanLain == 1 || agunanLain == 2) {
                    document.getElementById("divTglHgb").style.display = '';
                } else if (agunanLain != 1 || agunanLain != 2) {
                    document.getElementById("divTglHgb").style.display = 'none';
                }

            }

            function showPengikatanLainnya() {
                var pengikatanLain = document.getElementById("selectPengikatan").value;

                if (pengikatanLain == 7) {
                    document.getElementById("divPengikatanLainnya").style.display = '';
                } else {
                    document.getElementById("divPengikatanLainnya").style.display = 'none';
                }
            }

            function showCovenantLainnya() {
                var covenantLain = document.getElementById("selectCovenant").value;
                if (covenantLain == 5) {
                    document.getElementById("divCovenantLainnya").style.display = '';
                } else {
                    document.getElementById("divCovenantLainnya").style.display = 'none';
                }
            }

            function showDeviasiLainnya() {
                var deviasiLain = document.getElementById("selectDeviasi").value;
                if (deviasiLain == 6) {
                    document.getElementById("divDeviasiLainnya").style.display = '';
                } else {
                    document.getElementById("divDeviasiLainnya").style.display = 'none';
                }
            }

            function showTipePlafondLainnya() {
                var tipeLain = document.getElementById("tipePlafond").value;
                if (tipeLain == 8) {
                    document.getElementById("divTipeLainnya").style.display = '';
                } else {
                    document.getElementById("divTipeLainnya").style.display = 'none';
                }
            }
            
            function showDocumentLainnya() {
                var docLain = document.getElementById("selectDocument").value;
                if (docLain == 21) {
                    document.getElementById("divDocumentLainnya").style.display = '';
                } else {
                    document.getElementById("divDocumentLainnya").style.display = 'none';
                }
            }

            function  showNotaris() {
                var pilihNotaris = document.getElementById("selectPengikatanNotaris").value;
                if (pilihNotaris == 1) {
                    document.getElementById("divNamaNotaris").style.display = '';
                } else {
                    document.getElementById("divNamaNotaris").style.display = 'none';
                }
            }


            // table inisiasi
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableAsuransi1").DataTable();
                $('#tableAsuransi2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableCovenant1").DataTable();
                $('#tableCovenant2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableDeviasi1").DataTable();
                $('#tableDeviasi2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableFasilitas1").DataTable();
                $('#tableFasilitas2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableCovNote1").DataTable();
                $('#tableCovNote2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableAsuransiFas1").DataTable();
                $('#tableAsuransiFas2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
            $(function () {
                $("#tableDoc1").DataTable();
                $('#tableDoc2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });

            function sentAgunanForm() {

                // untuk KTA pilihan agunan bisa memilih jaminan lainnya,
                // field Lainnya menjadi mandatori

                if($('#selectAgunan').val() == 19){

                    if ($('#agunanLainnya').val().trim() == '') {
                        $('.statusAgunanLain').html('<span style="color:red;">Lainnya Wajib Diisi.</span>');
                        $('#agunanLainnya').focus();
                        return false;
                    }else {
                        $('.statusAgunanLain').html('<span style="color:red;"></span>');
                    }

                }else if($('#selectAgunan').val() == 11){
                    if ($('#agunanLainnya').val().trim() == '') {
                        $('.statusAgunanLain').html('<span style="color:red;">Lainnya Wajib Diisi.</span>');
                        $('#agunanLainnya').focus();
                        return false;
                    }else {
                        $('.statusAgunanLain').html('<span style="color:red;"></span>');
                    }

                    if($('#no_sertificate').val().trim() == ''){
                        $('.statusNoSertificateAgunan').html('<span style="color:red;">No. Certificate Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusNoSertificateAgunan').html('<span style="color:red;"></span>');
                    }

                    if ($('#selectAgunan').val() == 1 || $('#selectAgunan').val() == 2) {
                        if ($('#duedate').val().trim() == '') {
                            $('.statusDueDate').html('<span style="color:red;">DueDate HGB Wajib Diisi.</span>');
                            return false;
                        }else {
                            $('.statusDueDate').html('<span style="color:red;"></span>');
                        }
                    }

                    if($('#nama_pemilik').val().trim() == ''){
                        $('.statusNamaPemilikAgunan').html('<span style="color:red;">Nama Pemilik Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusNamaPemilikAgunan').html('<span style="color:red;"></span>');
                    }

                    if ($('#selectPengikatan').val() == 7) {
                        if ($('#pengikatanLainnya').val().trim() == '') {
                            $('.statusPengikatanLain').html('<span style="color:red;">Pengikatan Lain Wajib Diisi.</span>');
                            $('#pengikatanLainnya').focus();
                            return false;
                        }else {
                            $('.statusPengikatanLain').html('<span style="color:red;"></span>');
                        }
                    }

                }else {
                    if($('#alamatLokasi').val().trim() == ''){
                        $('.statusAlamatAgunan').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusAlamatAgunan').html('<span style="color:red;"></span>');
                    }

                    if($('#no_sertificate').val().trim() == ''){
                        $('.statusNoSertificateAgunan').html('<span style="color:red;">No. Certificate Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusNoSertificateAgunan').html('<span style="color:red;"></span>');
                    }

                    if ($('#selectAgunan').val() == 1 || $('#selectAgunan').val() == 2) {
                        if ($('#duedate').val().trim() == '') {
                            $('.statusDueDate').html('<span style="color:red;">DueDate HGB Wajib Diisi.</span>');
                            return false;
                        }else {
                            $('.statusDueDate').html('<span style="color:red;"></span>');
                        }
                    }

                    if($('#nama_pemilik').val().trim() == ''){
                        $('.statusNamaPemilikAgunan').html('<span style="color:red;">Nama Pemilik Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusNamaPemilikAgunan').html('<span style="color:red;"></span>');
                    }

                    if ($('#selectPengikatan').val() == 7) {
                        if ($('#pengikatanLainnya').val().trim() == '') {
                            $('.statusPengikatanLain').html('<span style="color:red;">Pengikatan Lain Wajib Diisi.</span>');
                            $('#pengikatanLainnya').focus();
                            return false;
                        }else {
                            $('.statusPengikatanLain').html('<span style="color:red;"></span>');
                        }
                    }

                }

                $.ajax({
                    type: 'post',
                    url: 'pages/legal/pendingList/action-CrmForm.php',
                    dataType: 'html',
                    data:$('#form-agunan').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.statusMsg').html('<span style="color:green;">Data Agunan Telah Tersimpan.</p>');
                            $('.submitBtn').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.statusMsg').html('<span style="color:red;">Data Agunan Gagal Tersimpan.</p>');
                        } else {
                            $('.statusMsg').html('<span style="color:red;">Data Error.</p>');
                        }

                    }

                });


            }

            function sentCovenantForm() {
                if ($('#selectCovenant').val() == 5) {
                    if ($('#covenantLainnya').val().trim() == '') {
                        $('.covenantLainnyaStatus').html('<span style="color:red;">Covenant Lain Wajib Diisi.</span>');
                        $('#covenantLainnya').focus();
                        return false;
                    }
                }

                if ($('#TglMulaiCovenant').val().trim() == '') {
                    $('.tglMulaiCovStatus').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
                    return false;
                }else {
                    $('.tglMulaiCovStatus').html('<span style="color:red;"></span>');
                }

                if ($('#TglTargetCovenant').val().trim() == '') {
                    $('.tglTargetCovStatus').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                    return false;
                }else {
                    $('.tglTargetCovStatus').html('<span style="color:red;"></span>');
                }

                $.ajax({
                    type: 'post',
                    url: 'pages/legal/pendingList/action-covenant.php',
                    dataType: 'html',
                    data:$('#form-covenant').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.covenantStatus').html('<span style="color:green;">Data Covenant Telah Tersimpan.</p>');
                            $('.submitCovenantBtn').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.covenantStatus').html('<span style="color:red;">Data Covenant Gagal Tersimpan.</p>');
                        } else {
                            $('.covenantStatus').html('<span style="color:red;">Data Error.</p>');
                        }
                    }

                });
            }

            function sentDeviasiForm() {
                if ($('#selectDeviasi').val() == 6) {
                    if ($('#deviasiLainnya').val().trim() == '') {
                        $('.deviasiLainnyaStatus').html('<span style="color:red;">Deviasi Lain Wajib Diisi.</span>');
                        $('#deviasiLainnya').focus();
                        return false;
                    }else {
                        $('.deviasiLainnyaStatus').html('<span style="color:red;"></span>');
                    }
                }

                if ($('#TglMulaiDeviasi').val().trim() == '') {
                    $('.deviasiTglMulaiStatus').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
                    return false;
                }else {
                    $('.deviasiTglMulaiStatus').html('<span style="color:red;"></span>');
                }

                if ($('#TglTargetDeviasi').val().trim() == '') {
                    $('.deviasiTglTargetStatus').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                    return false;
                }else {
                    $('.deviasiTglTargetStatus').html('<span style="color:red;"></span>');
                }

                if ($('#keteranganDeviasi').val().trim() == '') {
                    $('.deviasiKeteranganStatus').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                    $('#keteranganDeviasi').focus();
                    return false;
                }else {
                    $('.deviasiKeteranganStatus').html('<span style="color:red;"></span>');
                }

                $.ajax({
                    type: 'post',
                    url: 'pages/legal/pendingList/action-deviasi.php',
                    dataType: 'html',
                    data:$('#form-deviasi-detail').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.deviasiStatus').html('<span style="color:green;">Data Deviasi Telah Tersimpan.</p>');
                            $('.submitDeviasiBtn').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.deviasiStatus').html('<span style="color:red;">Data Deviasi Gagal Tersimpan.</p>');
                        } else {
                            $('.deviasiStatus').html('<span style="color:red;">Data Error.</p>');
                        }
                    }
                });
            }

            function sentKPForm() {
                var txtIdCrmDeviasi = $('#id_Crm').val();
                var txtStatusProgress = 5; // 5 == review progress
                $.ajax({
                    type: 'post',
                    url: 'pages/legal/pendingList/action-CrmForm.php',
                    dataType: 'html',
                    data: 'formSentKPIdCrm=' + txtIdCrmDeviasi + '&statusProgress=' + txtStatusProgress,
                    success: function (msg) {
                        if (msg == 'ok') {
                            /*$('.submitKPBtn').attr("disabled", "disabled");*/
                            alert("Anda akan kembali kehalaman sebelumnya");
                            history.back();
                        }

                    }
                });
            }

            function sentFasilitas() {
                if($('#selectAgunanFas').val() == '' || $('#selectAgunanFas').val() == null){
                    $('.statusPilihanJamininanMsg').html('<span style="color:red;">Pilihan Agunan Yang Tersedia Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.statusPilihanJamininanMsg').html('<span style="color:red;"></span>');
                }

                if ($('#SeqFasilitas').val().trim() == '') {
                    $('.statusSeqFasilitas').html('<span style="color:red;">Seq. Number  Wajib Diisi.</span>');
                    $('#SeqFasilitas').focus();
                    return false;
                } else {
                    $('.statusSeqFasilitas').html('<span style="color:red;"></span>');
                }

                if ($('#plafondFas').val().trim() == '') {
                    $('.statusPlafFasilitas').html('<span style="color:red;">Plafond Wajib Diisi.</span>');
                    $('#plafondFas').focus();
                    return false;
                } else {
                    $('.statusPlafFasilitas').html('<span style="color:red;"></span>');
                }

                if ($('#tipePlafond').val() == 8) {
                    if ($('#tipeLainnya').val().trim() == '') {
                        $('.statusTipeLain').html('<span style="color:red;">Tipe Lain Wajib Diisi.</span>');
                        $('#tipeLainnya').focus();
                        return false;
                    } else {
                        $('.statusTipeLain').html('<span style="color:red;"></span>');
                    }
                }

                if($('#selectFasilitas').val() == 1){

                }else {
                    if ($('#caraPenarikan').val().trim() == '') {
                        $('.statusCaraPenarikanFas').html('<span style="color:red;">Cara Penarikan Wajib Diisi.</span>');
                        $('#caraPenarikan').focus();
                        return false;
                    }
                }




                $.ajax({
                    url: "pages/legal/pendingList/action-fasilitas.php",
                    method: "POST",
                    data: $('#form-fasilitas').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.statusFasilitasMsg').html('<span style="color:green;">Data Fasilitas Telah Tersimpan.</p>');
                            $('.submitFasBtn').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.statusFasilitasMsg').html('<span style="color:red;">Data Fasilitas Gagal Tersimpan.</p>');
                        } else {
                            $('.statusFasilitasMsg').html('<span style="color:red;">Data Error.</p>');
                        }
                    }

                });

            }

            function sentCovernote() {
                if ($('#tglPengikatan').val().trim() == '') {
                    $('.statusTglPengikatan').html('<span style="color:red;">Tgl. Pengikatan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.statusTglPengikatan').html('<span style="color:red;"></span>');
                }

                if ($('#selectPengikatanNotaris').val() == 1) {
                    if ($('#namaNotaris').val().trim() == '') {
                        $('.statusNamaNotaris').html('<span style="color:red;">Nama Notaris Wajib Diisi.</span>');
                        $('#namaNotaris').focus();
                        return false;
                    } else {
                        $('.statusNamaNotaris').html('<span style="color:red;"></span>');
                    }
                } else {
                    $('.statusNamaNotaris').html('<span style="color:red;"></span>');
                }

                if ($('#noCovernote').val().trim() == '') {
                    $('.statusNoCovernote').html('<span style="color:red;">No. Covernote Wajib Diisi.</span>');
                    $('#noCovernote').focus();
                    return false;
                } else {
                    $('.statusNoCovernote').html('<span style="color:red;"></span>');
                }

                if ($('#tglCovernote').val().trim() == '') {
                    $('.statusTglCovernote').html('<span style="color:red;">Tgl. Covernote Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.statusTglCovernote').html('<span style="color:red;"></span>');
                }


                $.ajax({
                    url: "pages/legal/pendingList/action-covernote.php",
                    method: "POST",
                    data: $('#form-covernote').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.statusCovernoteMSG').html('<span style="color:green;">Data Covernote Telah Tersimpan.</p>');
                            $('.submitCovernote').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.statusCovernoteMSG').html('<span style="color:red;">Data Covernote Gagal Tersimpan.</p>');
                        } else {
                            $('.statusCovernoteMSG').html('<span style="color:red;">Data Error.</p>');
                        }
                    }

                });


            }

            function sentDocumentForm() {
                if($('#selectDocument').val() == 21){
                    if($('#docLainnya').val().trim() == ''){
                        $('.docLainnyaStatus').html('<span style="color:red;">Document Lain Wajib Diisi.</span>');
                        $('#docLainnya').focus();
                        return false;
                    } else {
                        $('.docLainnyaStatus').html('<span style="color:red;"></span>');
                    }
                }

                if($('#TglMulaiDoc').val().trim() == ''){
                    $('.tglMulaiDocStatus').html('<span style="color:red;">Tgl. Pengurusan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglMulaiDocStatus').html('<span style="color:red;"></span>');
                }

                if($('#TglTargetDoc').val().trim() == ''){
                    $('.tglTargetDocStatus').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglTargetDocStatus').html('<span style="color:red;"></span>');
                }

                $.ajax({
                    url: "pages/legal/pendingList/action-document.php",
                    method: "POST",
                    data: $('#form-document').serialize(),
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('.documentStatusMsg').html('<span style="color:green; ">Data Document Telah Tersimpan.</p>');
                            $('.submitDocumentBtn').attr("disabled", "disabled");
                            $('.modal-body').css('opacity', '.5');
                        } else if (msg == 'sql') {
                            $('.documentStatusMsg').html('<span style="color:red;">Data Document Gagal Tersimpan.</p>');
                        } else {
                            $('.documentStatusMsg').html('<span style="color:red;">Data Error.</p>');
                        }
                    }

                });

            }

            function selectFasilitasToGetFasCode() {
                var fasilitas = $('#selectFasilitas').val();
                if (fasilitas == 1) {
                    $('#codeFasilitas').val('PRK');
                } else if (fasilitas == 2) {
                    $('#codeFasilitas').val('DL');
                } else if (fasilitas == 3) {
                    $('#codeFasilitas').val('DLN');
                } else if (fasilitas == 4) {
                    $('#codeFasilitas').val('DLD');
                } else if (fasilitas == 5) {
                    $('#codeFasilitas').val('BG');
                } else if (fasilitas == 6) {
                    $('#codeFasilitas').val('IL');
                } else if (fasilitas == 7) {
                    $('#codeFasilitas').val('KI');
                } else if (fasilitas == 8) {
                    $('#codeFasilitas').val('KI-GP');
                } else if (fasilitas == 9) {
                    $('#codeFasilitas').val('KI-MAS');
                } else if (fasilitas == 10) {
                    $('#codeFasilitas').val('KMG');
                } else if (fasilitas == 11) {
                    $('#codeFasilitas').val('KPR');
                } else if (fasilitas == 12) {
                    $('#codeFasilitas').val('KKB');
                } else if (fasilitas == 13) {
                    $('#codeFasilitas').val('KI-LINE');
                } else if (fasilitas == 14) {
                    $('#codeFasilitas').val('BG-LINE');
                }
            }
        </script>
        <?php
    } else {
        die ("Error. Non ID CRM Selected. ");
    }

} else {
    die ("Error. NIK Not Found. ");
}

