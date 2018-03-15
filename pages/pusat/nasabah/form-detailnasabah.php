<?php
include "assets/koneksi.php";
session_start();
if (isset($_GET['id_crm']) && isset($_SESSION['nik'])) {
    $idCrm = $_GET['id_crm'];
    $sql = mysqli_query($Open, "select a.cabang,c.nama_marketing,a.nama_debitur, a.cif, a.ppk, a.crm, a.tgl_terimacrm, a.status, a.keterangan
                                           from tb_inputcrm a 
                                           left join master_marketing c on c.nik_marketing = a.nik_marketing
                                           where a.id_crm = '$idCrm' ");
    $result = mysqli_fetch_array($sql);

    // get current status progress
    $sqlProgress = mysqli_query($Open, "select * from master_statusaplikasi where id_progress = $result[7]");


    ?>
    <div class="box box-body">
        <section class="content">
            <ul class="breadcrumb">
                <li class="active">Detail Debitur</li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="#" class="form-horizontal" id="form-DetailNasabah" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left">Cabang</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?= $result[0] ?>" name="cabang" readonly="readonly">
                                    <input type="hidden" name="id_crm_detail_nasabah" value="<?=$idCrm?>">
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
                                <label class="col-sm-2 control-label" style="text-align: left">Tgl. Terima CRM</label>
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
                                    <select class="form-control" id="status-progress" name="status-progress" onchange="showKeterangan();">
                                        <?php
                                            while($rowStatusProgress = mysqli_fetch_array($sqlProgress)){
                                                echo '<option value="' . $rowStatusProgress[0] . '">' . $rowStatusProgress[1] . '</option>';
                                            }
                                            echo getStatusAplikasi();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="div_keterangan">
                                <label class="col-sm-2 control-label" style="text-align: left">Keterangan</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" id="status-keterangan" name="status-keterangan" placeholder="keterangan" ><?=$result[8]?></textarea>
                                    <p class="notStatusKeterangan"></p>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-yahoo pull-right submitDetailNasabah" onclick="sentStatusDebitur();">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
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
                <li><a data-toggle="tab" href="#signpk">Sign PK</a></li>
                <li><a data-toggle="tab" href="#pencairan">Pencairan</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="agunan" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
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
                                        <th style="text-align: center">Status Jaminan</th>
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
                                                                                            ,a.duedate_hgb
                                                                                            ,c.jenis_pengikatanagunan
                                                                                            ,d.status_progress
                                                                                            ,a.nilai_penjaminan
                                                                                            ,a.create_at
                                                                                            ,a.tgl_penyelesaian
                                                                                            ,a.jaminan_lain
                                                                                            from tb_inputjaminan a
                                                                                            left join master_jenisagunan b on b.id_jenisagunan = a.jaminan
                                                                                            left join master_jenispengikatanagunan c on c.id_jenispengikatanagunan = a.pengikatan
                                                                                            left join master_statusprogress d on d.id_progress = a.status
                                                                                       where a.id_crm = '$idCrm'  order by a.create_at DESC ");

                                    $no = 0;
                                    while ($rowAgunan = mysqli_fetch_array($sqlAgunan)) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?= $no + 1 ?></td>
                                            <td><?= $rowAgunan[1] ?></td>
                                            <td><?= $rowAgunan[10] ?></td>
                                            <td><?= $rowAgunan[2] ?></td>
                                            <td><?= $rowAgunan[3] ?></td>
                                            <td><?= $rowAgunan[4] ?></td>
                                            <td><?= $rowAgunan[5] ?></td>
                                            <td><?= $rowAgunan[7] ?></td>
                                            <td><?= $rowAgunan[9] ?></td>
                                            <td><?= $rowAgunan[6] ?></td>
                                            <td align="center">
                                                <a href="pages/pusat/nasabah/form-updateagunan.php?&idAgunan=<?= $rowAgunan[0] ?>"
                                                   data-toggle="modal" data-target="#modalUpdateAgunan"
                                                   title="Update"><i class="fa  fa-unlock"></i>
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
                <!-- Start Modal Update Agunan -->
                <div class="modal fade" id="modalUpdateAgunan" data-keyboard="false" data-backdrop="static"
                     role="dialog">
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

                                                <a href="pages/pusat/nasabah/form-penarikan.php?&idInputFas=<?= $rowFasilitas[0] ?>"
                                                   data-toggle="modal" data-target="#modalPenarikan"
                                                   title="Update Penarikan"><i class="fa  fa-underline"></i>
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
                <!-- Start Modal Update Penarikan -->
                <div class="modal fade" id="modalPenarikan" data-keyboard="false" data-backdrop="static"
                     role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"></div>
                    </div>
                </div>
                <!-- End Modal Update Penarikan -->
            </div>
            <div id="covernote" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
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
            </div>
            <div id="covenant" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
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

                                    $sqlCovenant = mysqli_query($Open, "SELECT a.id_input_covenant,b.syarat, a.syarat_lainnya, a.tgl_mulai, a.tgl_target, a.tgl_pemenuhan, c.status_progress
                                                                              FROM tb_inputcovenant a
                                                                                left join master_syaratcovenant b on a.id_syarat = b.id_syarat
                                                                                left join master_statusprogress c on a.status_progress = c.id_progress
                                                                                where a.id_crm = '$idCrm' order by a.create_at DESC ");
                                    $no = 0;
                                    while ($rowCovenant = mysqli_fetch_array($sqlCovenant)) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?= $no + 1 ?></td>
                                            <td><?= $rowCovenant[1] ?></td>
                                            <td><?= $rowCovenant[2] ?></td>
                                            <td><?= $rowCovenant[3] ?></td>
                                            <td><?= $rowCovenant[4] ?></td>
                                            <td><?= $rowCovenant[5] ?></td>
                                            <td><?= $rowCovenant[6] ?></td>
                                            <td align="center">
                                                <a href="pages/pusat/nasabah/form-updatecovenant.php?&idInputCovenant=<?=$rowCovenant[0];?>"
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
                <!-- Start Modal Update Covenant -->
                <div class="modal fade" id="modalUpdateCovenant" data-keyboard="false" data-backdrop="static"
                     role="dialog">
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
                                        <th style="text-align: center">Status Document</th>
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
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?= $no + 1 ?></td>
                                            <td><?= $rowDoc[1] ?></td>
                                            <td><?= $rowDoc[2] ?></td>
                                            <td><?= $rowDoc[3] ?></td>
                                            <td><?= $rowDoc[4] ?></td>
                                            <td><?= $rowDoc[5] ?></td>
                                            <td><?= $rowDoc[6] ?></td>
                                            <td align="center">
                                                <a href="pages/pusat/nasabah/form-updatedoc.php?&id_inputdoc=<?= $rowDoc[0] ?>"
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
                        <div class="modal-content">
                        </div>
                    </div>
                </div>
                <!-- End Modal Update Document -->
            </div>
            <div id="deviasi" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
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
                                        <th style="text-align: center">Status Deviasi</th>
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
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?= $no + 1 ?></td>
                                            <td><?= $rowDeviasi[2] ?></td>
                                            <td><?= $rowDeviasi[3] ?></td>
                                            <td><?= $rowDeviasi[4] ?></td>
                                            <td><?= $rowDeviasi[5] ?></td>
                                            <td><?= $rowDeviasi[6] ?></td>
                                            <td><?= $rowDeviasi[7] ?></td>
                                            <td><?= $rowDeviasi[8] ?></td>
                                            <td align="center">
                                                <a href="pages/pusat/nasabah/form-updatedeviasi.php?&id_inputdeviasi=<?= $rowDeviasi[1] ?>"
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
            <div id="signpk" class="tab-pane fade">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body">
                            <table id="tableSign1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="text-align: center">No.</th>
                                    <th style="text-align: center">No. PK</th>
                                    <th style="text-align: center">Tgl. Pengurusan</th>
                                    <th style="text-align: center">Tgl. Target</th>
                                    <th style="text-align: center">Tgl. Pemenuhan</th>
                                    <th style="text-align: center">Tgl. Masuk Khasanah</th>
                                    <th style="text-align: center">Status Sign PK</th>
                                    <!--<th style="text-align: center">Action</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sqlSign = mysqli_query($Open, "SELECT 
                                                                                            a.id_inputsign
                                                                                            ,a.no_pk
                                                                                            ,a.tgl_pengurusan
                                                                                            ,a.tgl_target
                                                                                            ,a.tgl_pemenuhan
                                                                                            ,a.tgl_khasanah
                                                                                            ,b.status_progress
                                                                                        FROM `tb_inputsignpk` a 
                                                                                            left join master_statusprogress b on a.status = b.id_progress
                                                                                        WHERE a.id_crm = '" . $idCrm . "'");

                                $no = 0;
                                while ($rowSign = mysqli_fetch_array($sqlSign)) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?= $no + 1 ?></td>
                                        <td><?= $rowSign[1] ?></td>
                                        <td><?= $rowSign[2] ?></td>
                                        <td><?= $rowSign[3] ?></td>
                                        <td><?= $rowSign[4] ?></td>
                                        <td><?= $rowSign[5] ?></td>
                                        <td><?= $rowSign[6] ?></td>
                                        <!--<td align="center">
                                            <a href="pages/legal/sign-in/form-updatesign.php?&idSign=<?/*= $rowSign[0] */?>"
                                               data-toggle="modal" data-target="#modalUpdateSign"
                                               title="Update">
                                                <i class="fa  fa-unlock"></i>
                                            </a>
                                        </td>-->
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
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalUpdateSign"
                     role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content"></div>
                    </div>
                </div>
                <!-- End Modal Update Asuransi Fasilitas -->


            </div>
            <div id="pencairan" class="tab-pane fade">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body">
                            <table id="tablePencairan1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="text-align: center">No.</th>
                                    <th style="text-align: center">Tgl. Pencairan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sqlPencairan = mysqli_query($Open, "SELECT 
                                                                                            a.id_pencairan
                                                                                            ,tgl_pencairan
                                                                                        FROM tb_inputpencairan a 
                                                                                        WHERE a.id_crm = '" . $idCrm . "'");

                                $no = 0;
                                while ($rowPencairan = mysqli_fetch_array($sqlPencairan)) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?= $no + 1 ?></td>
                                        <td style="text-align: center"><?= $rowPencairan[1] ?></td>
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
        </div>
    </div>
    <script>
        $(document).ready(function () {
            if(($('#status-progress').val() == 4 || $('#status-progress').val() == 2 || $('#status-progress').val() == 3|| $('#status-progress').val() == 7)){
                document.getElementById("div_keterangan").style.display = '';
            }else{
                document.getElementById("div_keterangan").style.display = 'none';
            }

            $('#datePickerTglPenyelesaianUpdateCovenant').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });

        function showKeterangan() {
            if(($('#status-progress').val() == 4 || $('#status-progress').val() == 2  || $('#status-progress').val() == 3 || $('#status-progress').val() == 7)){
                document.getElementById("div_keterangan").style.display = '';
            }else{
                document.getElementById("div_keterangan").style.display = 'none';
            }

            $('#datePickerTglPenyelesaianUpdateCovenant').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });

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
            $("#tableSign1").DataTable();
            $('#tableSign2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        $(function () {
            $("#tableSign1").DataTable();
            $('#tableSign2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        $(function () {
            $("#tableSign1").DataTable();
            $('#tableSign2').DataTable({
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
            $("#tablePencairan1").DataTable();
            $('#tablePencairan2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        function sentStatusDebitur () {
            if($('#status-progress').val().trim() == ''){
                $('.notStatusKeterangan').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                $('#status-progress').focus();
                return false;
            } else {
                $('.notStatusKeterangan').html('<span style="color:red;"></span>');
            }

            $.ajax({
                url: "pages/pusat/nasabah/action-detailnasabah.php",
                method: "POST",
                data: $('#form-DetailNasabah').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        alert("Data Berhasil Disimpan.");
                        history.back();
                    } else if (msg == 'sql') {
                       alert("Data Query Gagal Disimpan.");
                    } else {
                        alert("Data Error");
                    }
                }

            });

        }

    </script>




    <?php
} else {
    echo "<p>Data Error</p>";
}