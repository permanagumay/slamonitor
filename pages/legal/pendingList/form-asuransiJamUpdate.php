<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['idAsuransiJam']) && isset($_SESSION['nik'])) {
    $idAsuransi = $_GET['idAsuransiJam'];

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
                                      from tb_inputasuransi where id_asuransi = '$idAsuransi'");
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
                    <p class="statusAsuransiJamMsgUpdate"></p>
                    <form role="form" action="#" class="form-horizontal" id="form-InputAsuransiJaminanUpdate"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" value="<?= $idAsuransi ?>" name="idInputJamUpdate">
                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Asuransi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectAsuransiJamUpdate"
                                            name="selectAsuransiJamUpdate" onchange="showAsuransiLainnya()">
                                        <?php
                                        while ($rowJenAs = mysqli_fetch_array($sqlJenAs)) {
                                            echo '<option value="' . $rowJenAs[0] . '">' . $rowJenAs[1] . '</option>';
                                        }
                                        echo getMasterJenisAsuransiJaminan();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divAsuransiLainnyaJamUpdate">
                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="asuransiLainnyaJamUpdate"
                                           name="asuransiLainnyaJamUpdate" value="<?= $result[2] ?>"
                                           placeholder="asuransi lainnya">
                                    <p class="statusAsuransiLainJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Objek Asuransi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectObjekAsuransiJamUpdate"
                                            name="selectObjekAsuransiJamUpdate" onchange="showObjekLainnya()">
                                        <?php
                                        while ($rowObjAs = mysqli_fetch_array($sqlObjAsu)) {
                                            echo '<option value="' . $rowObjAs[0] . '">' . $rowObjAs[1] . '</option>';
                                        }
                                        echo getMasterObjekAsuransi();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divObjekLainnyaJamUpdate">
                                <label class="col-sm-4 control-label" style="text-align: left"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="objekLainnyaJamUpdate" name="objekLainnyaJamUpdate"
                                           value="<?= $result[4] ?>"
                                           placeholder="objek lainnya">
                                    <p class="statusobjekLainJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Alamat/Lokasi</label>
                                <div class="col-sm-8">
                                <textarea class="form-control" id="alamatLokasiAsuransiJamUpdate"
                                          name="alamatLokasiAsuransiJamUpdate"
                                          placeholder="alamat/lokasi"><?= $result[5] ?></textarea>
                                    <p class="statusAlamatJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nilai
                                    Pertanggungan</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="nilaiPertanggunganJamUpdate"
                                           name="nilaiPertanggunganJamUpdate"
                                           placeholder="nilai pertanggungan" value="<?= $result[6] ?>"
                                           onkeyup="validAngka(this)">
                                    <p class="statusNilaiPertanggunganJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Nama Asuransi</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="namaAsuransiJamUpdate" name="namaAsuransiJamUpdate"
                                           value="<?= $result[7] ?>"
                                           placeholder="nama asuransi">
                                    <p class="statusNamaAsuransiJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">No. Polis</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="polisJamUpdate" name="polisJamUpdate"
                                           value="<?= $result[8] ?>" placeholder="no. polis">
                                    <p class="statusPolisJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerMulaiAsuransiJamUpdate">
                                        <input class="form-control" id="tglMulaiAsuransiJamUpdate"
                                               name="tglMulaiAsuransiJamUpdate" value="<?= $result[9] ?>"
                                               placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglMulaiJamUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl.Berakhir</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerBerakhirAsuransiJamUpdate">
                                        <input class="form-control" id="tglBerakhirAsuransiJamUpdate"
                                               name="tglBerakhirAsuransiJamUpdate" value="<?= $result[10] ?>"
                                               placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglSelesaiJamUpdate"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitAsuransiJamUpdate"
                    onclick="sentAsuransiJamUpdate()">Submit
            </button>
            <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                    onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            if ($('#selectAsuransiJamUpdate').val() == 3) {
                document.getElementById("divAsuransiLainnyaJamUpdate").style.display = '';
            } else {
                document.getElementById("divAsuransiLainnyaJamUpdate").style.display = 'none';
            }

            if ($('#selectObjekAsuransiJamUpdate').val() == 6) {
                document.getElementById("divObjekLainnyaJamUpdate").style.display = '';
            } else {
                document.getElementById("divObjekLainnyaJamUpdate").style.display = 'none';
            }

            $('#datePickerMulaiAsuransiJamUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerBerakhirAsuransiJamUpdate').datepicker({
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
            var asuransiLain = document.getElementById("selectAsuransiJamUpdate").value;

            if (asuransiLain == 3) {
                document.getElementById("divAsuransiLainnyaJamUpdate").style.display = '';
            } else {
                document.getElementById("divAsuransiLainnyaJamUpdate").style.display = 'none';
            }

        }

        function showObjekLainnya() {
            var ObjekLain = document.getElementById("selectObjekAsuransiJamUpdate").value;

            if (ObjekLain == 6) {
                document.getElementById("divObjekLainnyaJamUpdate").style.display = '';
            } else {
                document.getElementById("divObjekLainnyaJamUpdate").style.display = 'none';
            }

        }

        function sentAsuransiJamUpdate() {
            if ($('#selectAsuransiJamUpdate').val() == 3) {
                if ($('#asuransiLainnyaJamUpdate').val().trim() == '') {
                    $('.statusAsuransiLainJamUpdate').html('<span style="color:red;">Asuransi Lain Wajib Diisi.</span>');
                    $('#asuransiLainnyaJamUpdate').focus();
                    return false;
                } else {
                    $('.statusAsuransiLainJamUpdate').html('<span style="color:red;"></span>');
                }
            }

            if ($('#selectObjekAsuransiJamUpdate').val() == 6) {
                if ($('#objekLainnyaJamUpdate').val().trim() == '') {
                    $('.statusobjekLainJamUpdate').html('<span style="color:red;">Objek Lain Wajib Diisi.</span>');
                    $('#objekLainnyaJamUpdate').focus();
                    return false;
                } else {
                    $('.statusobjekLainJamUpdate').html('<span style="color:red;"></span>');
                }
            }

            if ($('#alamatLokasiAsuransiJamUpdate').val() == '') {
                $('.statusAlamatJamUpdate').html('<span style="color:red;">Alamat Wajib Diisi.</span>');
                $('#alamatLokasiAsuransiJamUpdate').focus();
                return false;
            } else {
                $('.statusAlamatJamUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#nilaiPertanggunganJamUpdate').val() == '' || $('#nilaiPertanggunganJamUpdate').val() == 0) {
                $('.statusNilaiPertanggunganJamUpdate').html('<span style="color:red;">Nilai Pertanggungan Wajib Diisi.</span>');
                $('#nilaiPertanggunganJamUpdate').focus();
                return false;
            } else {
                $('.statusNilaiPertanggunganJamUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#namaAsuransiJamUpdate').val() == '') {
                $('.statusNamaAsuransiJamUpdate').html('<span style="color:red;">Nama Asuransi Wajib Diisi.</span>');
                $('#namaAsuransiJamUpdate').focus();
                return false;
            } else {
                $('.statusNamaAsuransiJamUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#polisJamUpdate').val() == '') {
                $('.statusPolisJamUpdate').html('<span style="color:red;">Polis Wajib Diisi.</span>');
                $('#polisJamUpdate').focus();
                return false;
            } else {
                $('.statusPolisJamUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#tglMulaiAsuransiJamUpdate').val().trim() == '') {
                $('.statusTglMulaiJamUpdate').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
                return false;
            } else {
                $('.statusTglMulaiJamUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#tglBerakhirAsuransiJamUpdate').val().trim() == '') {
                $('.statusTglSelesaiJamUpdate').html('<span style="color:red;">Tgl. Berakhir Wajib Diisi.</span>');
                return false;
            } else {
                $('.statusTglSelesaiJamUpdate').html('<span style="color:red;"></span>');
            }

            $.ajax({
                url: "pages/legal/pendingList/action-updateasuransijaminan.php",
                method: "POST",
                data: $('#form-InputAsuransiJaminanUpdate').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.statusAsuransiJamMsgUpdate').html('<span style="color:green;">Data Asuransi Telah Tersimpan.</p>');
                        $('.submitAsuransiJamUpdate').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.statusAsuransiJamMsgUpdate').html('<span style="color:red;">Data Asuransi Gagal Tersimpan.</p>');
                    } else {
                        $('.statusAsuransiJamMsgUpdate').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });


        }
    </script>
    <?php
} else {
    echo "<p>Data Error</p>";
}