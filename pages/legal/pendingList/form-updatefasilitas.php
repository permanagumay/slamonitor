<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['idInputFas'])) {
    $idInputFasilitas = $_GET['idInputFas'];
    $sql = mysqli_query($Open, "select id_inputfasilitas
                                            , id_agunan
                                            , jenis_fasilitas
                                            , fascode
                                            , plafond
                                            , id_tipkredit
                                            , tipkreditlain
                                       from tb_inputfasilitas where id_inputfasilitas = '$idInputFasilitas'");

    $result = mysqli_fetch_array($sql);

    // get value for select jaminan
    $getAgunan = mysqli_query($Open, "select a.id_agunan, b.jenis_agunan, a.no_certificate, a.nilai_penjaminan, a.id_crm  from tb_inputjaminan a
                                            join master_jenisagunan b on a.jaminan = id_jenisagunan
                                            where a.id_agunan = '$result[1]'");
    // get value id_crm
    $getIdCrm = mysqli_fetch_array($getAgunan);

    // get value for select tipe plafond
    $getTipPlaf = mysqli_query($Open, "select * from master_tipekredit where id_tipekredit = '$result[5]'");

    // get value for jenis fasilitas
    $getJenFas = mysqli_query($Open,"select * from master_fasilitas where id_fasilitas = '$result[2]'");

    // get current seq. code
    if($result[2] == 1){
        $seqCode = substr($result[3],3);
    }else if($result[2] == 2){
        $seqCode = substr($result[3],2);
    }else if($result[2] ==  3){
        $seqCode = substr($result[3],3);
    }else if($result[2] ==  4){
        $seqCode = substr($result[3],3);
    }else if($result[2] ==  5){
        $seqCode = substr($result[3],2);
    }else if($result[2] ==  6){
        $seqCode = substr($result[3],2);
    }else if($result[2] ==  7){
        $seqCode = substr($result[3],2);
    }else if($result[2] ==  8){
        $seqCode = substr($result[3],5);
    }else if($result[2] ==  9){
        $seqCode = substr($result[3],6);
    }else if($result[2] ==  10){
        $seqCode = substr($result[3],3);
    }else if($result[2] ==  11){
        $seqCode = substr($result[3],3);
    }else if($result[2] ==  12){
        $seqCode = substr($result[3],3);
    }else if($result[2] ==  13){
        $seqCode = substr($result[3],7);
    }else if($result[2] ==  14){
        $seqCode = substr($result[3],7);
    }
    ?>
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Update Fasilitas</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="statusFasMSGUpdate"></p>
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-fasilitasUpdate">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Jenis Agunan Tersedia</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectAgunanFasUpdate" name="selectAgunanFasUpdate">
                                            <?php
                                            while ($rowJaminanUpdate = mysqli_fetch_array($getAgunan)) {
                                                echo '<option value="'.$rowJaminanUpdate[0].'">'.$rowJaminanUpdate[1].', '.$rowJaminanUpdate[2].', '.$rowJaminanUpdate[3].'</option>';
                                            }
                                                echo getJaminanByIdCrm($getIdCrm[4]);
                                            ?>
                                        </select>
                                        <input type="hidden" id="idInputFasUpdate" name="idInputFasUpdate" value="<?= $idInputFasilitas ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tipe Plafond</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="tipePlafondUpdate" name="tipePlafondUpdate" onchange="showTipePlafondLainnya()">
                                            <?php
                                                while($rowTipeKreditUpdate = mysqli_fetch_array($getTipPlaf)){
                                                    echo '<option value="' . $rowTipeKreditUpdate[0] . '">' . $rowTipeKreditUpdate[1] . '</option>';
                                                }
                                                echo getTipeKredit();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="divTipeLainnyaUpdate">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="tipeLainnyaUpdate" name="tipeLainnyaUpdate" value="<?= $result[6] ?>" placeholder="tipe lainnya"/>
                                        <p class="statusTipeLainUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Jenis Fasilitas</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectFasilitasUpdate" name="selectFasilitasUpdate" onchange="selectFasilitasToGetFasCode()">
                                            <?php
                                                while($rowGetFas = mysqli_fetch_array($getJenFas)){
                                                    echo '<option value="' . $rowGetFas[0] . '">' . $rowGetFas[1] . '</option>';
                                                }
                                                echo getMasterFasilitas();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="codeFasilitasUpdate" name="codeFasilitasUpdate" readonly="readonly"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="SeqFasilitasUpdate" name="SeqFasilitasUpdate" placeholder="seq. number facilites" value="<?=$seqCode?>" onkeyup="validAngka(this)" ><!--onkeyup="validAngka(this)"-->
                                        <p class="statusSeqFasilitasUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Plafond Fasilitas</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="plafondFasUpdate" name="plafondFasUpdate" value="<?= $result[4]?>" onkeyup="validAngka(this)"/>
                                        <p class="statusPlafFasilitasUpdate"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitUpdateFasilitas" onclick="sentUpdateFasilitas()">
                Submit
            </button>
            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
    </div>
<script>
    $(document).ready(function () {
        document.getElementById("divTipeLainnyaUpdate").style.display = 'none';
        if($('#tipePlafondUpdate').val() == 8){
            document.getElementById("divTipeLainnyaUpdate").style.display = '';
        }else {
            document.getElementById("divTipeLainnyaUpdate").style.display = 'none';
        }

        selectFasilitasToGetFasCode();
    });

    function showTipePlafondLainnya() {
        if($('#tipePlafondUpdate').val() == 8){
            document.getElementById("divTipeLainnyaUpdate").style.display = '';
        }else {
            document.getElementById("divTipeLainnyaUpdate").style.display = 'none';
        }
    }

    function selectFasilitasToGetFasCode() {
        var fasilitas = $('#selectFasilitasUpdate').val();
        if (fasilitas == 1) {
            $('#codeFasilitasUpdate').val('PRK');
        } else if (fasilitas == 2) {
            $('#codeFasilitasUpdate').val('DL');
        } else if (fasilitas == 3) {
            $('#codeFasilitasUpdate').val('DLN');
        } else if (fasilitas == 4) {
            $('#codeFasilitasUpdate').val('DLD');
        } else if (fasilitas == 5) {
            $('#codeFasilitasUpdate').val('BG');
        } else if (fasilitas == 6) {
            $('#codeFasilitasUpdate').val('IL');
        } else if (fasilitas == 7) {
            $('#codeFasilitasUpdate').val('KI');
        } else if (fasilitas == 8) {
            $('#codeFasilitasUpdate').val('KI-GP');
        } else if (fasilitas == 9) {
            $('#codeFasilitasUpdate').val('KI-MAS');
        } else if (fasilitas == 10) {
            $('#codeFasilitasUpdate').val('KMG');
        } else if (fasilitas == 11) {
            $('#codeFasilitas').val('KPR');
        } else if (fasilitas == 12) {
            $('#codeFasilitasUpdate').val('KKB');
        } else if (fasilitas == 13) {
            $('#codeFasilitasUpdate').val('KI-LINE');
        } else if (fasilitas == 14) {
            $('#codeFasilitasUpdate').val('BG-LINE');
        }
    }

    function sentUpdateFasilitas() {
        if($('#SeqFasilitasUpdate').val().trim() == ''){
            $('.statusSeqFasilitasUpdate').html('<span style="color:red;">Seq. Number  Wajib Diisi.</span>');
            $('#SeqFasilitasUpdate').focus();
            return false;
        } else {
            $('.statusSeqFasilitasUpdate').html('<span style="color:red;"></span>');
        }

        if($('#plafondFasUpdate').val().trim()== ''){
            $('.statusPlafFasilitasUpdate').html('<span style="color:red;">Seq. Number  Wajib Diisi.</span>');
            $('#plafondFasUpdate').focus();
            return false;
        } else {
            $('.statusPlafFasilitasUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            url: "pages/legal/pendingList/action-updatefasilitas.php",
            method: "POST",
            data: $('#form-fasilitasUpdate').serialize(),
            success: function (msg) {
                if (msg == 'ok') {
                    $('.statusFasMSGUpdate').html('<span style="color:green;">Data Fasilitas Telah Tersimpan.</p>');
                    $('.submitUpdateFasilitas').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusFasMSGUpdate').html('<span style="color:red;">Data Fasilitas Gagal Tersimpan.</p>');
                } else {
                    $('.statusFasMSGUpdate').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });

    }
</script>
<?php
} else {
    echo "<p>Data Error</p>";
}