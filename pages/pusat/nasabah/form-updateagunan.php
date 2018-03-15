<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idAgunan']) && isset($_SESSION['nik'])){

    $idInputAgunan = $_GET['idAgunan'];

    $sql = mysqli_query($Open, "select a.jaminan 
                                             ,a.jaminan_lain
                                             ,a.alamat
                                             ,a.no_certificate
                                             ,a.duedate_hgb
                                             ,a.nama_pemilik
                                             ,a.pengikatan
                                             ,a.pengikatan_lain
                                             ,a.no_akta
                                             ,a.nilai_penjaminan
                                             ,a.tgl_pengurusan
                                             ,a.tgl_target
                                             ,a.tgl_khasanah
                                             ,a.status
                                             ,a.id_agunan
                                             ,a.tgl_penyelesaian
                                      from tb_inputjaminan a where a.id_agunan = '$idInputAgunan'");
    $result = mysqli_fetch_array($sql);

    // get current status progress
    $sqlProgress = mysqli_query($Open, "select * from master_statusprogress where id_progress = $result[13]");

    if($result[10] == '0000-00-00'){
        $tglPengurusan = '';
    }else {
        $tglPengurusan = $result[10];
    }
    if($result[11] == '0000-00-00'){
        $tglTarget = '';
    }else {
        $tglTarget = $result[11];
    }
    if($result[12] == '0000-00-00'){
        $tglKhasanah = '';
    }else {
        $tglKhasanah = $result[12];
    }
    if($result[4] == '0000-00-00'){
        $tglHgb = '';
    }else {
        $tglHgb = $result[4];
    }
    if($result[15] == '0000-00-00'){
        $tglSelesai = '';
    }else {
        $tglSelesai = $result[15];
    }

    $sqlMasterAgunan = mysqli_query($Open, "select * from master_jenisagunan where id_jenisagunan = '$result[0]'");
    $sqlMasterPengikatan = mysqli_query($Open, "select * from master_jenispengikatanagunan where id_jenispengikatanagunan = '$result[6]'");

    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ccccff">
                <h4><b>Update Agunan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="updateAgunanStatus"></p>
                        <form role="form" action="#" class="form-horizontal" id="form-updateJaminan" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Jenis Agunan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdateAgunan" name="selectUpdateAgunan" disabled="disabled">
                                                <?php
                                                while($rowAgunan = mysqli_fetch_array($sqlMasterAgunan)){
                                                    echo '<option value="' . $rowAgunan[0] . '">' . $rowAgunan[1] . '</option>';
                                                }
                                                echo getMasterAgunan();
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="idJaminanUpdate" name="idJaminanUpdate" value="<?=$result[14]?>">
                                    </div>
                                    <div class="form-group" id="divUpdateAgunanLainnya">
                                        <label class="col-sm-4 control-label"
                                               style="text-align: left"></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateAgunanLainnya" name="updateAgunanLainnya" placeholder="agunan lainnya" value="<?=$result[1]?>" readonly="readonly">
                                            <p class="statusUpdateAgunanLain"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="updateAlamatLokasi" name="updateAlamatLokasi" placeholder="alamat/lokasi" readonly="readonly"><?=$result[2]?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">No.Certificate/Jaminan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNo_sertificate" name="updateNo_sertificate" placeholder="no. certificate/jaminan" value="<?=$result[3]?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdateTglHgb">
                                        <label class="col-sm-4 control-label" style="text-align: left">Due Date (HGB)</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateDueDate">
                                                <input class="form-control" id="updateDuedate" name="updateDuedate" placeholder="yyyy/mm/dd" value="<?=$tglHgb?>" readonly="readonly"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="statusUpdateDueDate"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Nama Pemilik/Penjamin</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNama_pemilik" name="updateNama_pemilik" placeholder="nama pemilik/penjamin" value="<?= $result[5]?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Jenis Pengikatan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdatePengikatan" name="selectUpdatePengikatan" disabled="disabled">
                                                <?php
                                                while($rowPengikatan = mysqli_fetch_array($sqlMasterPengikatan)){
                                                    echo '<option value="' . $rowPengikatan[0] . '">' . $rowPengikatan[1] . '</option>';
                                                }
                                                echo getMasterPengikatan(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdatePengikatanLainnya">
                                        <label class="col-sm-4 control-label" style="text-align: left"></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updatePengikatanLainnya" name="updatePengikatanLainnya" placeholder="pengikatan lainnya" value="<?=$result[7]?>" readonly="readonly">
                                            <p class="statusUpdatePengikatanLain"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">No. Akta Pengikatan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNomorAkta" name="updateNomorAkta" placeholder="no. akta pengikatan" value="<?=$result[8]?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Nilai Penjaminan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNilaiJaminan" name="updateNilaiJaminan" onkeyup="validAngka(this)" placeholder="nilai penjaminan" value="<?=$result[9]?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl.Pengurusan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdatePengurusan">
                                                <input class="form-control" id="updateAgunanTglPengurusan" name="updateAgunanTglPengurusan" placeholder="yyyy/mm/dd" value="<?=$tglPengurusan?>" readonly="readonly"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateTarget">
                                                <input class="form-control" id="updateAgunanTglTarget" name="updateAgunanTglTarget" placeholder="yyyy/mm/dd" value="<?=$tglTarget?>" readonly="readonly"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Masuk Khasanah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateKhasanah">
                                                <input class="form-control" id="updateTglKhasanah" name="updateTglKhasanah" placeholder="yyyy/mm/dd" value="<?=$tglKhasanah?>" readonly="readonly"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Penyelesaian</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdatePenyelesaian">
                                                <input class="form-control" id="updateTglPenyelesaian" name="updateTglPenyelesaian" value="<?=$tglSelesai?>" placeholder="yyyy/mm/dd"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="statusUpdateTglSelesai"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Status Jaminan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="status-progressUpdate" name="status-progressUpdate">
                                                <?php
                                                while($rowStatusProgress = mysqli_fetch_array($sqlProgress)){
                                                    echo '<option value="' . $rowStatusProgress[0] . '">' . $rowStatusProgress[1] . '</option>';
                                                }
                                                echo getStatusProgress();
                                                ?>
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
                <button type="button" class="btn btn-yahoo pull-right submitUpdateAgunan" onclick="sentUpdateAgunanForm()">Submit
                </button>
                <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">Kembali/Cancel
                </button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById("divUpdateAgunanLainnya").style.display = 'none';
            document.getElementById("divUpdatePengikatanLainnya").style.display = 'none';
            document.getElementById("divUpdateTglHgb").style.display = 'none';

            var selectUpdateAgunan = $('#selectUpdateAgunan').val();
            if(selectUpdateAgunan == 1 || selectUpdateAgunan == 2){
                document.getElementById("divUpdateTglHgb").style.display = '';
            }else {
                document.getElementById("divUpdateTglHgb").style.display = 'none';
            }

            if(selectUpdateAgunan == 19 || selectUpdateAgunan == 11 ){
                document.getElementById("divUpdateAgunanLainnya").style.display = '';
            }else {
                document.getElementById("divUpdateAgunanLainnya").style.display = 'none';
            }

            var selectUpdatePengikatan = $('#selectUpdatePengikatan').val();
            if(selectUpdatePengikatan == 7 ){
                document.getElementById("divUpdatePengikatanLainnya").style.display = '';
            }else {
                document.getElementById("divUpdatePengikatanLainnya").style.display = 'none';
            }


            $('#datePickerUpdatePenyelesaian').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function sentUpdateAgunanForm() {
            console.log($('#status-progressUpdate').val());
            if($('#status-progressUpdate').val() == 1){

                if($('#updateTglPenyelesaian').val().trim() == ''){
                    $('.statusUpdateTglSelesai').html('<span style="color:red;">Tgl. Penyelesaian Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.statusUpdateTglSelesai').html('<span style="color:red;"></span>');
                }
            }

            $.ajax({
                url:"pages/pusat/nasabah/action-updatejaminan.php",
                method:"POST",
                data:$('#form-updateJaminan').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.updateAgunanStatus').html('<span style="color:green;">Data Jaminan Telah Tersimpan.</p>');
                        $('.submitUpdateAgunan').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.updateAgunanStatus').html('<span style="color:red;">Data Jaminan Gagal Tersimpan.</p>');
                    } else {
                        $('.updateAgunanStatus').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });
        }
    </script>
    <?php
}else {
    echo "<p>Data Error</p>";
}