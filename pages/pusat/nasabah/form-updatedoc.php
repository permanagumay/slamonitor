<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['id_inputdoc']) && isset($_SESSION['nik'])) {
    $idInputDoc = $_GET['id_inputdoc'];
    $nik = $_SESSION['nik'];

    $sql = mysqli_query($Open, "select 
                                        id_doc
                                        ,doc_lain
                                        ,tgl_pengurusan
                                        ,tgl_target
                                        ,tgl_pemenuhan
                                        ,status                                      
                                      from tb_inputdoc where id_inputdoc = '$idInputDoc'");
    $result = mysqli_fetch_array($sql);

    if($result[4] == '0000-00-00'){
        $tglPemenuhan = '';
    }else {
        $tglPemenuhan = $result[4];
    }
    if($result[2] == '0000-00-00'){
        $tglPengurusan = '';
    }else {
        $tglPengurusan = $result[2];
    }
    if($result[3] == '0000-00-00'){
        $tglTarget = '';
    }else {
        $tglTarget = $result[3];
    }

    // get current document
    $sqlDoc = mysqli_query($Open, "select * from master_document where id_masterdoc = '$result[0]'");

    // get current status progress
    $sqlProgress = mysqli_query($Open, "select * from master_statusprogress where id_progress = $result[5]");
    ?>
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Detail Document TBO</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="updateDocumentStatusMsg"></p>
                    <form role="form" action="#" class="form-horizontal"  id="form-updateDocument" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Jenis Document</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectDocumentUpdate" name="selectDocumentUpdate" onchange="showDocumentLainnya();" disabled="disabled">
                                            <?php
                                            while($rowDoc = mysqli_fetch_array($sqlDoc)){
                                                echo '<option value="' . $rowDoc[0] . '">' . $rowDoc[1] . '</option>';
                                            }
                                            echo getDokument(); ?>
                                        </select>
                                        <input type="hidden" name="id_inputDoc" value="<?=$idInputDoc?>">
                                    </div>
                                </div>
                                <div class="form-group" id="divDocumentUpdateLainnya">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="docLainnyaUpdate" name="docLainnyaUpdate" placeholder="document lainnya" value="<?=$result[1]?>" disabled="disabled">
                                        <p class="docLainnyaStatusUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengurusan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglMulaiDocUpdate">
                                            <input class="form-control" id="TglMulaiDocUpdate" name="TglMulaiDocUpdate" placeholder="yyyy/mm/dd" value="<?=$tglPengurusan?>" disabled="disabled"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="tglMulaiDocStatusUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglTargetDocUpdate">
                                            <input class="form-control" id="TglTargetDocUpdate" name="TglTargetDocUpdate" placeholder="yyyy/mm/dd" value="<?=$tglTarget?>" disabled="disabled"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="tglTargetDocStatusUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pemenuhan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglPemenuhanDocUpdate">
                                            <input class="form-control" id="TglPemenuhanDocUpdate" name="TglPemenuhanDocUpdate" placeholder="yyyy/mm/dd" value="<?=$tglPemenuhan?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="tglSelesaiDocStatusUpdate"></p>
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
            <button type="button" class="btn btn-yahoo pull-right submitUpdateDocumentBtn" onclick="sentDocumentForm()">
                Submit
            </button>
            <button type="button" class="btn btn-facebook pull-right"  onclick="window.location.reload()">
                Kembali/Cancel
            </button>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            if($('#selectDocumentUpdate').val() == 21){
                document.getElementById("divDocumentUpdateLainnya").style.display = '';
            }else {
                document.getElementById("divDocumentUpdateLainnya").style.display = 'none';
            }


            $('#datePickerTglPemenuhanDocUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });



        function sentDocumentForm() {
            console.log($('#status-progressUpdate').val());
            if($('#status-progressUpdate').val() == 1){
                if($('#TglPemenuhanDocUpdate').val().trim() == ''){
                    $('.tglSelesaiDocStatusUpdate').html('<span style="color:red;">Tgl. Penyelesaian Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglSelesaiDocStatusUpdate').html('<span style="color:red;"></span>');
                }
            }
            $.ajax({
                url:"pages/pusat/nasabah/action-updatedoc.php",
                method:"POST",
                data:$('#form-updateDocument').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.updateDocumentStatusMsg').html('<span style="color:green;">Data Document Telah Tersimpan.</p>');
                        $('.submitUpdateDocumentBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.updateDocumentStatusMsg').html('<span style="color:red;">Data Document Gagal Tersimpan.</p>');
                    } else {
                        $('.updateDocumentStatusMsg').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });
        }


    </script>

    <?php
} else {
    echo "<p>Data Error</p>";
}