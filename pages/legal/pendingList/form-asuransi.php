<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idAgunan']) && isset($_SESSION['nik']) ){
    $idAgunan = $_GET['idAgunan'];
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ccccff">
                <h4><b>Input Asuransi</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="statusAsuransiJamMsg"></p>
                        <form role="form" action="#" class="form-horizontal" id="form-InputAsuransiJaminan" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="hidden" value="<?=$idAgunan?>" id="idAgunan" name="idAgunanAsuJam">
                                    <label class="col-sm-4 control-label" style="text-align: left">Jenis Asuransi</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectAsuransi" name="selectAsuransi" onchange="showAsuransiLainnya()">
                                            <?php echo getMasterJenisAsuransiJaminan(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="divAsuransiLainnya" style="display: none">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="asuransiLainnya" name="asuransiLainnya" placeholder="asuransi lainnya">
                                        <p class="statusAsuransiJamLain"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Objek Asuransi</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectObjekAsuransi" name="selectObjekAsuransi" onchange="showObjekLainnya()">
                                            <?php echo getMasterObjekAsuransi(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="divObjekLainnya" style="display: none">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="objekLainnya" name="objekLainnya" placeholder="objek lainnya">
                                        <p class="statusobjekJamLain"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                    <div class="col-sm-8">
                                       <textarea class="form-control" id="alamatLokasiAsuransi" name="alamatLokasiAsuransi" placeholder="alamat/lokasi"></textarea>
                                       <p class="statusAlamatJam"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Nilai Pertanggungan</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="nilaiPertanggungan" name="nilaiPertanggungan" placeholder="nilai pertanggungan" onkeyup="validAngka(this)" required>
                                        <p class="statusNilaiPertanggunganJam"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Nama Asuransi</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="namaAsuransi" name="namaAsuransi" placeholder="nama asuransi">
                                        <p class="statusNamaAsuransiJam"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">No. Polis</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="polis" name="polis" placeholder="no. polis">
                                        <p class="statusPolisJam"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerMulaiAsuransi">
                                            <input class="form-control" id="tglMulaiAsuransi" name="tglMulaiAsuransi" placeholder="yyyy/mm/dd"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="statusTglMulaiJam"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl.Berakhir</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerBerakhirAsuransi">
                                            <input class="form-control" id="tglBerakhirAsuransi" name="tglBerakhirAsuransi" placeholder="yyyy/mm/dd"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="statusTglSelesaiJam"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yahoo pull-right submitBtnAsuransi" onclick="sentAsuransiForm()">Submit
                </button>
                <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right" onclick="window.location.reload()">Kembali/Cancel
                </button>
            </div>
        </div>
    </div>

    <script>

        function validAngka(a) {
            if (!/^[0-9.]+$/.test(a.value)) {
                a.value = a.value.substring(0, a.value.length - 1000);
            }
        }

        function showAsuransiLainnya() {
            var asuransiLain = document.getElementById("selectAsuransi").value;

            if (asuransiLain == 3) {
                document.getElementById("divAsuransiLainnya").style.display = '';
            } else {
                document.getElementById("divAsuransiLainnya").style.display = 'none';
            }

        }

        function showObjekLainnya() {
            var ObjekLain = document.getElementById("selectObjekAsuransi").value;

            if (ObjekLain == 6) {
                document.getElementById("divObjekLainnya").style.display = '';
            } else {
                document.getElementById("divObjekLainnya").style.display = 'none';
            }

        }

        $(document).ready(function () {
            $('#datePickerMulaiAsuransi').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerBerakhirAsuransi').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function sentAsuransiForm() {
            if($('#selectAsuransi').val() == 3){
                if($('#asuransiLainnya').val().trim() == ''){
                    $('.statusAsuransiJamLain').html('<span style="color:red;">Asuransi Lain Wajib Diisi.</span>');
                    $('#asuransiLainnya').focus();
                    return false;
                } else {
                    $('.statusAsuransiJamLain').html('<span style="color:red;"></span>');
                }
            }

            if($('#selectObjekAsuransi').val() == 6){
                if($('#objekLainnya').val().trim() == ''){
                    $('.statusobjekJamLain').html('<span style="color:red;">Objek Lain Wajib Diisi.</span>');
                    $('#objekLainnya').focus();
                    return false;
                } else {
                    $('.statusobjekJamLain').html('<span style="color:red;"></span>');
                }
            }

           if($('#alamatLokasiAsuransi').val() == ''){
                $('.statusAlamatJam').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
                $('#alamatLokasiAsuransi').focus();
                return false;
            } else {
                $('.statusAlamatJam').html('<span style="color:red;"></span>');
            }

            if($('#nilaiPertanggungan').val() == '' || $('#nilaiPertanggungan').val() == 0 ){
                $('.statusNilaiPertanggunganJam').html('<span style="color:red;">Nilai Pertanggungan Wajib Diisi.</span>');
                $('#nilaiPertanggungan').focus();
                return false;
            } else {
                $('.statusNilaiPertanggunganJam').html('<span style="color:red;"></span>');
            }

            if($('#namaAsuransi').val() == ''){
                $('.statusNamaAsuransiJam').html('<span style="color:red;">Nama Asuransi Wajib Diisi.</span>');
                $('#namaAsuransi').focus();
                return false;
            } else {
                $('.statusNamaAsuransiJam').html('<span style="color:red;"></span>');
            }

            if($('#polis').val() == ''){
                $('.statusPolisJam').html('<span style="color:red;">Polis Wajib Diisi.</span>');
                $('#polis').focus();
                return false;
            } else {
                $('.statusPolisJam').html('<span style="color:red;"></span>');
            }

            if($('#tglMulaiAsuransi').val().trim() == ''){
                $('.statusTglMulaiJam').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
                return false;
            } else {
                $('.statusTglMulaiJam').html('<span style="color:red;"></span>');
            }

            if($('#tglBerakhirAsuransi').val().trim() == ''){
                $('.statusTglSelesaiJam').html('<span style="color:red;">Tgl. Berakhir Wajib Diisi.</span>');
                return false;
            } else {
                $('.statusTglSelesaiJam').html('<span style="color:red;"></span>');
            }


            $.ajax({
                url:"pages/legal/pendingList/action-AsuransiForm.php",
                method:"POST",
                data:$('#form-InputAsuransiJaminan').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.statusAsuransiJamMsg').html('<span style="color:green;">Data Asuransi Telah Tersimpan.</p>');
                        $('.submitBtnAsuransi').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.statusAsuransiJamMsg').html('<span style="color:red;">Data Asuransi Gagal Tersimpan.</p>');
                    } else {
                        $('.statusAsuransiJamMsg').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });
        }


    </script>
<?php
}else {
    echo "<p>Data Error</p>";
}