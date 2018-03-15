<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idAgunan']) && isset($_SESSION['nik'])){

    $idInputAgunan = $_GET['idAgunan'];
    $nik = $_SESSION['nik'];

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
                                      from tb_inputjaminan a where a.id_agunan = '$idInputAgunan'");
    $result = mysqli_fetch_array($sql);
    $sqlMasterAgunan = mysqli_query($Open, "select * from master_jenisagunan where id_jenisagunan = '$result[0]'");
    $sqlMasterPengikatan = mysqli_query($Open, "select * from master_jenispengikatanagunan where id_jenispengikatanagunan = '$result[6]'");

    if($result[9] == 0){
        $nilaiJaminan = '';
    }else {
        $nilaiJaminan = $result[9];
    }

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
                        <form role="form" id="form-update-agunan" action="#" class="form-horizontal" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Jenis Agunan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdateAgunan" name="selectUpdateAgunan" onchange="showUpdateAgunanLainnya()">
                                                <?php
                                                while($rowAgunan = mysqli_fetch_array($sqlMasterAgunan)){
                                                    echo '<option value="' . $rowAgunan[0] . '">' . $rowAgunan[1] . '</option>';
                                                }
                                                echo getMasterAgunan();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdateAgunanLainnya">
                                        <label class="col-sm-4 control-label" style="text-align: left"></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateAgunanLainnya" name="updateAgunanLainnya" placeholder="agunan lainnya" value="<?=$result[1]?>">
                                            <p class="statusUpdateAgunanLain"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                        <div class="col-sm-8">
                                             <textarea class="form-control" id="updateAlamatLokasi" name="updateAlamatLokasi" placeholder="alamat/lokasi"><?=$result[2]?></textarea>
                                            <p class="statusUpdateAlamatAgunan"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">No.Certificate/Jaminan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNo_sertificate" name="updateNo_sertificate" placeholder="no. certificate/jaminan" value="<?=$result[3]?>">
                                            <p class="statusUpdateNoCertificateAgunan"></p>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdateTglHgb">
                                        <label class="col-sm-4 control-label" style="text-align: left">Due Date (HGB)</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateDueDate">
                                                <input class="form-control" id="updateDuedate" name="updateDuedate" placeholder="yyyy/mm/dd" value="<?=$result[4]?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="statusUpdateDueDate"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Nama Pemilik/Penjamin</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNama_pemilik" name="updateNama_pemilik" placeholder="nama pemilik/penjamin" value="<?= $result[5]?>">
                                            <p class="statusUpdateNamaPemilik"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Jenis Pengikatan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdatePengikatan" name="selectUpdatePengikatan" onchange="showUpdatePengikatanLainnya()">
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
                                            <input class="form-control" id="updatePengikatanLainnya" name="updatePengikatanLainnya" placeholder="pengikatan lainnya" value="<?=$result[7]?>">
                                            <p class="statusUpdatePengikatanLain"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">No. Akta Pengikatan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNomorAkta" name="updateNomorAkta" placeholder="no. akta pengikatan" value="<?=$result[8]?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Nilai Penjaminan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateNilaiJaminan" name="updateNilaiJaminan" onkeyup="validAngka(this)" placeholder="nilai penjaminan" value="<?=$nilaiJaminan?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl.Pengurusan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdatePengurusan">
                                                <input class="form-control" id="updateAgunanTglPengurusan" name="updateAgunanTglPengurusan" placeholder="yyyy/mm/dd" value="<?=$tglPengurusan?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateTarget">
                                                <input class="form-control" id="updateAgunanTglTarget" name="updateAgunanTglTarget" placeholder="yyyy/mm/dd" value="<?=$tglTarget?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Masuk Khasanah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerUpdateKhasanah">
                                                <input class="form-control" id="updateKhasanahDate" name="updateKhasanahDate" placeholder="yyyy/mm/dd" value="<?=$tglKhasanah?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>                                                
                                            </div>
                                        </div>
                                    </div>
									<input type="hidden" id="idAgunan" name="idAgunan" value="<?=$idInputAgunan?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yahoo pull-right submitUpdateAgunan" onclick="sentUpdateAgunanForm()">
                    Submit
                </button>
                <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right submitAgunanKembali" onclick="window.location.reload()">
                    Kembali/Cancel
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

            if($('#selectUpdateAgunan').val() == 19 || $('#selectUpdateAgunan').val() == 11 ){
                document.getElementById("divUpdateAgunanLainnya").style.display = '';
            }

            var selectUpdatePengikatan = $('#selectUpdatePengikatan').val();
            if(selectUpdatePengikatan == 7 ){
                document.getElementById("divUpdatePengikatanLainnya").style.display = '';
            }else {
                document.getElementById("divUpdatePengikatanLainnya").style.display = 'none';
            }

            $('#datePickerUpdateDueDate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerUpdatePengurusan').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerUpdateTarget').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerUpdateKhasanah').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });


        });

        function validAngka(a) {
            if (!/^[0-9.]+$/.test(a.value)) {
                a.value = a.value.substring(0, a.value.length - 1000);
            }
        }

        function showUpdateAgunanLainnya() {

            var selectUpdateAgunan = document.getElementById("selectUpdateAgunan").value;
            if (selectUpdateAgunan == 19) {
                document.getElementById("divUpdateAgunanLainnya").style.display = '';
            }else {
                document.getElementById("divUpdateAgunanLainnya").style.display = 'none';
            }

            if(selectUpdateAgunan == 1 || selectUpdateAgunan == 2){
                document.getElementById("divUpdateTglHgb").style.display = '';
            }else {
                document.getElementById("divUpdateTglHgb").style.display = 'none';
            }
        }

        function showUpdatePengikatanLainnya() {
            var selectUpdatePengikatan = $('#selectUpdatePengikatan').val();
            if(selectUpdatePengikatan == 7 ){
                document.getElementById("divUpdatePengikatanLainnya").style.display = '';
            }else {
                document.getElementById("divUpdatePengikatanLainnya").style.display = 'none';
            }
        }



        function sentUpdateAgunanForm() {

            if($('#selectUpdateAgunan').val() == 19){

                if ($('#updateAgunanLainnya').val().trim() == '') {
                    $('.statusUpdateAgunanLain').html('<span style="color:red;">Agunan Lain Wajib Diisi.</span>');
                    $('#updateAgunanLainnya').focus();
                    return false;
                }else {
                    $('.statusUpdateAgunanLain').html('<span style="color:red;"></span>');
                }

            }else {

                if($('#updateAlamatLokasi').val().trim() == ''){
                    $('.statusUpdateAlamatAgunan').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
                    $('#updateAlamatLokasi').focus();
                    return false;
                }else {
                    $('.statusUpdateAlamatAgunan').html('<span style="color:red;"></span>');
                }

                if($('#updateNo_sertificate').val().trim() == ''){
                    $('.statusUpdateNoCertificateAgunan').html('<span style="color:red;">No. Certificate Wajib Diisi.</span>');
                    $('#updateNo_sertificate').focus();
                    return false;
                }else {
                    $('.statusUpdateNoCertificateAgunan').html('<span style="color:red;"></span>');
                }

                if ($('#selectUpdateAgunan').val() == 1 || $('#selectUpdateAgunan').val() == 2) {
                    if ($('#updateDuedate').val().trim() == '') {
                        $('.statusUpdateDueDate').html('<span style="color:red;">DueDate HGB Wajib Diisi.</span>');
                        return false;
                    }else {
                        $('.statusUpdateDueDate').html('<span style="color:red;"></span>');
                    }
                }

                if($('#updateNama_pemilik').val().trim() == ''){
                    $('.statusUpdateNamaPemilik').html('<span style="color:red;">Nama Pemilik Wajib Diisi.</span>');
                    $('#updateNama_pemilik').focus();
                    return false;
                }else {
                    $('.statusUpdateNamaPemilik').html('<span style="color:red;"></span>');
                }

                if ($('#selectUpdatePengikatan').val() == 7) {
                    if ($('#updatePengikatanLainnya').val().trim() == '') {
                        $('.statusUpdatePengikatanLain').html('<span style="color:red;">Pengikatan Lain Wajib Diisi.</span>');
                        $('#updatePengikatanLainnya').focus();
                        return false;
                    }else {
                        $('.statusUpdatePengikatanLain').html('<span style="color:red;"></span>');
                    }
                }

            }

            $.ajax({
                type: 'post',
                url: 'pages/legal/pendingList/action-updateagunan.php',
                dataType: 'html',
                data:$('#form-update-agunan').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.updateAgunanStatus').html('<span style="color:green;">Data Agunan Telah Tersimpan.</p>');
                        $('.submitUpdateAgunan').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    }else if(msg == 'sql') {
                        $('.updateAgunanStatus').html('<span style="color:red;">Data Agunan Gagal Tersimpan.</p>');
                    }else {
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