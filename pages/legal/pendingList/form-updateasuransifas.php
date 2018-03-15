<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idAsuransiFas'])&& isset($_SESSION['nik'])){
    $idInputFas = $_GET['idAsuransiFas'];
    $sql = mysqli_query($Open, "select
                                          id_asuransi
                                          , jenis_asuransi
                                          , asuransi_lain
                                          , objek_asuransi
                                          , objek_lain
                                          , alamat
                                          , nilai_pertanggungan
                                          , nama_asuransi
                                          , polis
                                          , start_date
                                          , end_date                                          
                                      from tb_inputasuransifasilitas where id_asuransi = '$idInputFas'");
    $result = mysqli_fetch_array($sql);

    // get jenis asuransi
    $sqlJenAs = mysqli_query($Open, "select * from master_jenisasuransi where id_jenisasuransi = '$result[1]'");

    // get objek asuransi
    $sqlObjAsu = mysqli_query($Open, "select * from master_objekasuransi where id_objekasuransi = '$result[3]'");
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Update Asuransi</b></h4>
        </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p class="statusAsuransiFasMsgUpdate"></p>
                <form role="form" action="#" class="form-horizontal" id="form-InputAsuransiFasilitasUpdate" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" value="<?= $idInputFas ?>" name="idInputFasUpdate">
                            <label class="col-sm-4 control-label" style="text-align: left">Jenis Asuransi</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="selectAsuransiFasUpdate" name="selectAsuransiFasUpdate" onchange="showAsuransiLainnya()">
                                        <?php
                                            while($rowJenAs = mysqli_fetch_array($sqlJenAs)){
                                                echo '<option value="' . $rowJenAs[0] . '">' . $rowJenAs[1] . '</option>';
                                            }
                                            echo getMasterJenisAsuransiFasilitas();
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="divAsuransiLainnyaFasUpdate">
                            <label class="col-sm-4 control-label" style="text-align: left"></label>
                            <div class="col-sm-8">
                                <input class="form-control" id="asuransiLainnyaFasUpdate" name="asuransiLainnyaFasUpdate" value="<?=$result[2]?>" placeholder="asuransi lainnya">
                                <p class="statusAsuransiLainFasUpdate"></p>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Objek Asuransi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectObjekAsuransiFasUpdate" name="selectObjekAsuransiFasUpdate" onchange="showObjekLainnya()">
                                        <?php
                                        while($rowObjAs = mysqli_fetch_array($sqlObjAsu)){
                                            echo '<option value="' . $rowObjAs[0] . '">' . $rowObjAs[1] . '</option>';
                                        }
                                            echo getMasterObjekAsuransi();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divObjekLainnyaFasUpdate">
                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="objekLainnyaFasUpdate" name="objekLainnyaFasUpdate" value="<?=$result[4]?>"
                                           placeholder="objek lainnya">
                                    <p class="statusobjekLainFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="alamatLokasiAsuransiFasUpdate" name="alamatLokasiAsuransiFasUpdate"
                                              placeholder="alamat/lokasi" ><?=$result[5]?></textarea>
                                    <p class="statusAlamatFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nilai
                                    Pertanggungan</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="nilaiPertanggunganFasUpdate" name="nilaiPertanggunganFasUpdate"
                                           placeholder="nilai pertanggungan" value="<?=$result[6]?>" onkeyup="validAngka(this)" >
                                    <p class="statusNilaiPertanggunganFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nama Asuransi</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="namaAsuransiFasUpdate" name="namaAsuransiFasUpdate" value="<?=$result[7]?>"
                                           placeholder="nama asuransi" >
                                    <p class="statusNamaAsuransiFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">No. Polis</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="polisFasUpdate" name="polisFasUpdate" value="<?=$result[8]?>" placeholder="no. polis">
                                    <p class="statusPolisFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerMulaiAsuransiFasUpdate">
                                        <input class="form-control" id="tglMulaiAsuransiFasUpdate" name="tglMulaiAsuransiFasUpdate" value="<?=$result[9]?>"
                                               placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglMulaiFasUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Berakhir</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerBerakhirAsuransiFasUpdate">
                                        <input class="form-control" id="tglBerakhirAsuransiFasUpdate" name="tglBerakhirAsuransiFasUpdate" value="<?=$result[10]?>"
                                               placeholder="yyyy/mm/dd" />
                                        <span class="input-group-addon add-on"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglSelesaiFasUpdate"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-yahoo pull-right submitAsuransiFasUpdate"
                    onclick="sentAsuransiFasUpdate()">Submit
        </button>
        <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                    onclick="window.location.reload()">Kembali/Cancel
        </button>
    </div>
</div>
<script>
    $(document).ready(function () {
        if($('#selectAsuransiFasUpdate').val() == 3){
            document.getElementById("divAsuransiLainnyaFasUpdate").style.display = '';
        }else {
            document.getElementById("divAsuransiLainnyaFasUpdate").style.display = 'none';
        }

        if($('#selectObjekAsuransiFasUpdate').val() == 6){
            document.getElementById("divObjekLainnyaFasUpdate").style.display = '';
        }else {
            document.getElementById("divObjekLainnyaFasUpdate").style.display = 'none';
        }

        $('#datePickerMulaiAsuransiFasUpdate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $('#datePickerBerakhirAsuransiFasUpdate').datepicker({
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
        var asuransiLain = document.getElementById("selectAsuransiFasUpdate").value;

        if (asuransiLain == 3) {
            document.getElementById("divAsuransiLainnyaFasUpdate").style.display = '';
        } else {
            document.getElementById("divAsuransiLainnyaFasUpdate").style.display = 'none';
        }

    }

    function showObjekLainnya() {
        var ObjekLain = document.getElementById("selectObjekAsuransiFasUpdate").value;

        if (ObjekLain == 6) {
            document.getElementById("divObjekLainnyaFasUpdate").style.display = '';
        } else {
            document.getElementById("divObjekLainnyaFasUpdate").style.display = 'none';
        }

    }
    
    function sentAsuransiFasUpdate() {
        if($('#selectAsuransiFasUpdate').val() == 3){
            if($('#asuransiLainnyaFasUpdate').val().trim() == ''){
                $('.statusAsuransiLainFasUpdate').html('<span style="color:red;">Asuransi Lain Wajib Diisi.</span>');
                $('#asuransiLainnyaFasUpdate').focus();
                return false;
            } else {
                $('.statusAsuransiLainFasUpdate').html('<span style="color:red;"></span>');
            }
        }

        if($('#selectObjekAsuransiFasUpdate').val() == 6){
            if($('#objekLainnyaFasUpdate').val().trim() == ''){
                $('.statusobjekLainFasUpdate').html('<span style="color:red;">Objek Lain Wajib Diisi.</span>');
                $('#objekLainnyaFasUpdate').focus();
                return false;
            } else {
                $('.statusobjekLainFasUpdate').html('<span style="color:red;"></span>');
            }
        }

        if($('#alamatLokasiAsuransiFasUpdate').val() == ''){
            $('.statusAlamatFasUpdate').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
            $('#alamatLokasiAsuransiFasUpdate').focus();
            return false;
        } else {
            $('.statusAlamatFasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#nilaiPertanggunganFasUpdate').val() == '' || $('#nilaiPertanggunganFasUpdate').val() == 0 ){
            $('.statusNilaiPertanggunganFasUpdate').html('<span style="color:red;">Nilai Pertanggungan Wajib Diisi.</span>');
            $('#nilaiPertanggunganFasUpdate').focus();
            return false;
        } else {
            $('.statusNilaiPertanggunganFasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#namaAsuransiFasUpdate').val() == ''){
            $('.statusNamaAsuransiFasUpdate').html('<span style="color:red;">Nama Asuransi Wajib Diisi.</span>');
            $('#namaAsuransiFasUpdate').focus();
            return false;
        } else {
            $('.statusNamaAsuransiFasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#polisFasUpdate').val() == ''){
            $('.statusPolisFasUpdate').html('<span style="color:red;">Polis Wajib Diisi.</span>');
            $('#polisFasUpdate').focus();
            return false;
        } else {
            $('.statusPolisFasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#tglMulaiAsuransiFasUpdate').val().trim() == ''){
            $('.statusTglMulaiFasUpdate').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglMulaiFasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#tglBerakhirAsuransiFasUpdate').val().trim() == ''){
            $('.statusTglSelesaiFasUpdate').html('<span style="color:red;">Tgl. Berakhir Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglSelesaiFasUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            url:"pages/legal/pendingList/action-updateasuransifasilitas.php",
            method:"POST",
            data:$('#form-InputAsuransiFasilitasUpdate').serialize(),
            success:function (msg) {
                if (msg == 'ok') {
                    $('.statusAsuransiFasMsgUpdate').html('<span style="color:green;">Data Asuransi Telah Tersimpan.</p>');
                    $('.submitAsuransiFasUpdate').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusAsuransiFasMsgUpdate').html('<span style="color:red;">Data Asuransi Gagal Tersimpan.</p>');
                } else {
                    $('.statusAsuransiFasMsgUpdate').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });

        
    }
</script>
<?php
}else {
    echo "<p>Data Error</p>";
}