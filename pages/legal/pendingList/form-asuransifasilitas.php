<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['idInputFas']) && isset($_SESSION['nik'])) {
    $idInputFas = $_GET['idInputFas'];
?>
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Input Asuransi</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12"><p class="statusAsuransiFasMsg"></p>
                    <form role="form" action="#" class="form-horizontal" id="form-InputAsuransiFasilitas" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" value="<?= $idInputFas ?>" name="idInputFas">
                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Asuransi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectAsuransiFas" name="selectAsuransiFas" onchange="showAsuransiLainnya()">
                                        <?php echo getMasterJenisAsuransiFasilitas(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divAsuransiLainnyaFas">
                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="asuransiLainnyaFas" name="asuransiLainnyaFas"
                                           placeholder="asuransi lainnya">
                                    <p class="statusAsuransiLainFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Objek Asuransi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectObjekAsuransiFas" name="selectObjekAsuransiFas"
                                            onchange="showObjekLainnya()">
                                        <?php echo getMasterObjekAsuransi(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divObjekLainnyaFas">
                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="objekLainnyaFas" name="objekLainnyaFas"
                                           placeholder="objek lainnya">
                                    <p class="statusobjekLainFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="alamatLokasiAsuransiFas" name="alamatLokasiAsuransiFas"
                                              placeholder="alamat/lokasi" ></textarea>
                                    <p class="statusAlamatFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nilai
                                    Pertanggungan</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="nilaiPertanggunganFas" name="nilaiPertanggunganFas"
                                           placeholder="nilai pertanggungan" onkeyup="validAngka(this)" >
                                    <p class="statusNilaiPertanggunganFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nama Asuransi</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="namaAsuransiFas" name="namaAsuransiFas"
                                           placeholder="nama asuransi" >
                                    <p class="statusNamaAsuransiFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">No. Polis</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="polisFas" name="polisFas" placeholder="no. polis">
                                    <p class="statusPolisFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date"
                                         id="datePickerMulaiAsuransiFas">
                                        <input class="form-control" id="tglMulaiAsuransiFas"
                                               name="tglMulaiAsuransiFas"
                                               placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglMulaiFas"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Berakhir</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date"
                                         id="datePickerBerakhirAsuransiFas">
                                        <input class="form-control" id="tglBerakhirAsuransiFas" name="tglBerakhirAsuransiFas"
                                               placeholder="yyyy/mm/dd" />
                                        <span class="input-group-addon add-on"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglSelesaiFas"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitAsuransiFas"
                    onclick="sentAsuransiFas()">Submit
            </button>
            <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                    onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
    </div>
<script>
    $(document).ready(function () {
        document.getElementById("divAsuransiLainnyaFas").style.display = 'none';
        document.getElementById("divObjekLainnyaFas").style.display = 'none';

        $('#datePickerMulaiAsuransiFas').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $('#datePickerBerakhirAsuransiFas').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
    });

    function validAngka(a) {
        if (!/^[0-9.]+$/.test(a.value)) {
            a.value = a.value.substring(0, a.value.length - 1000);
        }
    }

    function showAsuransiLainnya() {
        var asuransiLain = document.getElementById("selectAsuransiFas").value;

        if (asuransiLain == 3) {
            document.getElementById("divAsuransiLainnyaFas").style.display = '';
        } else {
            document.getElementById("divAsuransiLainnyaFas").style.display = 'none';
        }

    }

    function showObjekLainnya() {
        var ObjekLain = document.getElementById("selectObjekAsuransiFas").value;

        if (ObjekLain == 6) {
            document.getElementById("divObjekLainnyaFas").style.display = '';
        } else {
            document.getElementById("divObjekLainnyaFas").style.display = 'none';
        }

    }

    function sentAsuransiFas() {
        if($('#selectAsuransiFas').val() == 3){
            if($('#asuransiLainnyaFas').val().trim() == ''){
                $('.statusAsuransiLainFas').html('<span style="color:red;">Jenis Asuransi Lain Wajib Diisi.</span>');
                $('#asuransiLainnyaFas').focus();
                return false;
            } else {
                $('.statusAsuransiLainFas').html('<span style="color:red;"></span>');
            }
        }

        if($('#selectObjekAsuransiFas').val()== 6){
            if($('#objekLainnyaFas').val().trim() == ''){
                $('.statusobjekLainFas').html('<span style="color:red;">Objek Asuransi Lain Wajib Diisi.</span>');
                $('#objekLainnyaFas').focus();
                return false;
            } else {
                $('.statusobjekLainFas').html('<span style="color:red;"></span>');
            }
        }

        if($('#alamatLokasiAsuransiFas').val().trim() == ''){
            $('.statusAlamatFas').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
            $('#alamatLokasiAsuransiFas').focus();
            return false;
        } else {
            $('.statusAlamatFas').html('<span style="color:red;"></span>');
        }

        if($('#nilaiPertanggunganFas').val().trim() == 0 || $('#nilaiPertanggunganFas').val().trim() == ''){
            $('.statusNilaiPertanggunganFas').html('<span style="color:red;">Nilai Pertanggungan Wajib Diisi & Tidak Boleh 0.</span>');
            $('#nilaiPertanggunganFas').focus();
            return false;
        } else {
            $('.statusNilaiPertanggunganFas').html('<span style="color:red;"></span>');
        }

        if($('#namaAsuransiFas').val().trim()== ''){
            $('.statusNamaAsuransiFas').html('<span style="color:red;">Nama Asuransi Wajib Diisi.</span>');
            $('#namaAsuransiFas').focus();
            return false;
        } else {
            $('.statusNamaAsuransiFas').html('<span style="color:red;"></span>');
        }

        if($('#polisFas').val().trim()== ''){
            $('.statusPolisFas').html('<span style="color:red;">Polis Asuransi Wajib Diisi.</span>');
            $('#polisFas').focus();
            return false;
        } else {
            $('.statusPolisFas').html('<span style="color:red;"></span>');
        }

        if($('#tglMulaiAsuransiFas').val().trim()== ''){
            $('.statusTglMulaiFas').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglMulaiFas').html('<span style="color:red;"></span>');
        }

        if($('#tglBerakhirAsuransiFas').val().trim()== ''){
            $('.statusTglSelesaiFas').html('<span style="color:red;">Tgl. Selesai Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglSelesaiFas').html('<span style="color:red;"></span>');
        }

        $.ajax({
            url:"pages/legal/pendingList/action-asuransifasilitas.php",
            method:"POST",
            data:$('#form-InputAsuransiFasilitas').serialize(),
            success:function (msg) {
                if (msg == 'ok') {
                    $('.statusAsuransiFasMsg').html('<span style="color:green;">Data Asuransi Telah Tersimpan.</p>');
                    $('.submitAsuransiFas').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusAsuransiFasMsg').html('<span style="color:red;">Data Asuransi Gagal Tersimpan.</p>');
                } else {
                    $('.statusAsuransiFasMsg').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });
    }

</script>
<?php
} else {
    echo "<p>Data Error</p>";
}