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
                                      from tb_inputdoc where id_inputdoc = '$idInputDoc'");
    $result = mysqli_fetch_array($sql);

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
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
        <h4><b>Update Document TBO</b></h4>
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
                                    <select class="form-control" id="selectDocumentUpdate" name="selectDocumentUpdate" onchange="showDocumentLainnya();">
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
                                    <input class="form-control" id="docLainnyaUpdate" name="docLainnyaUpdate" placeholder="document lainnya" value="<?=$result[1]?>">
                                    <p class="docLainnyaStatusUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengurusan</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerTglMulaiDocUpdate">
                                        <input class="form-control" id="TglMulaiDocUpdate" name="TglMulaiDocUpdate" placeholder="yyyy/mm/dd" value="<?=$tglPengurusan?>"/>
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglMulaiDocStatusUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerTglTargetDocUpdate">
                                        <input class="form-control" id="TglTargetDocUpdate" name="TglTargetDocUpdate" placeholder="yyyy/mm/dd" value="<?=$tglTarget?>"/>
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglTargetDocStatusUpdate"></p>
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

        $('#datePickerTglMulaiDocUpdate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $('#datePickerTglTargetDocUpdate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
    });

    function showDocumentLainnya() {
        var docLain = document.getElementById("selectDocumentUpdate").value;
        if (docLain == 21) {
            document.getElementById("divDocumentUpdateLainnya").style.display = '';
        } else {
            document.getElementById("divDocumentUpdateLainnya").style.display = 'none';
        }
    }

    function sentDocumentForm() {
        if($('#selectDocumentUpdate').val() == 21){
            if($('#docLainnyaUpdate').val().trim() == ''){
                $('.docLainnyaStatusUpdate').html('<span style="color:red;">Document Lain  Wajib Diisi.</span>');
                $('#docLainnyaUpdate').focus();
                return false;
            } else {
                $('.docLainnyaStatusUpdate').html('<span style="color:red;"></span>');
            }
        }

        if($('#TglMulaiDocUpdate').val().trim() == ''){
            $('.tglMulaiDocStatusUpdate').html('<span style="color:red;">Tgl. Pengurusan  Wajib Diisi.</span>');
            return false;
        } else {
            $('.tglMulaiDocStatusUpdate').html('<span style="color:red;"></span>');
        }

        if($('#TglTargetDocUpdate').val().trim() == ''){
            $('.tglTargetDocStatusUpdate').html('<span style="color:red;">Tgl. Target  Wajib Diisi.</span>');
            return false;
        } else {
            $('.tglTargetDocStatusUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            url:"pages/legal/pendingList/action-updatedoc.php",
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