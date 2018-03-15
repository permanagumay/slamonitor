<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idInputCaraPen'])&& isset($_SESSION['nik'])){
    $idCaraPenarikan = $_GET['idInputCaraPen'];
    $sqlCaraPen = mysqli_query($Open, "select * from tb_inputcarapenarikan where id_carapenarikan = '".$idCaraPenarikan."'");
    $resultCaraPen = mysqli_fetch_array($sqlCaraPen);
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
        <h4><b>Update Penarikan</b></h4>
    </div>
    <div class="modal-body">
        <div class="row">
                        <div class="col-md-12">
                            <p class="statusPenarikanMSGUpdate"></p>
                            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-updatecarapenarikan">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" style="text-align: left">Cara Penarikan</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <textarea id="caraPenarikanUpdate" rows="6" name="caraPenarikanUpdate" class="form-control"  placeholder="cara penarikan"><?=$resultCaraPen[2]?> </textarea>
                                                <p class="statusCaraPenarikanUpdate"></p>
                                                <input type="hidden" name="idCaraPenarikanUpdate" value="<?=$idCaraPenarikan?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
    </div>
    </div>
    <div class="modal-footer">
                    <button type="button" class="btn btn-yahoo pull-right submitPenarikanUpdate"
                            onclick="sentUpdatePenarikan()">Submit
                    </button>
                    <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                            onclick="window.location.reload()">Kembali/Cancel
                    </button>
    </div>
</div>
<script>
    function sentUpdatePenarikan() {
        if($('#caraPenarikanUpdate').val().trim() == ''){
            $('.statusCaraPenarikanUpdate').html('<span style="color:red;">Cara Penarikan Wajib Diisi.</span>');
            $('#caraPenarikanUpdate').focus();
            return false;
        } else {
            $('.statusCaraPenarikanUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            url:"pages/legal/pendingList/action-updatepenarikan.php",
            method:"POST",
            data:$('#form-updatecarapenarikan').serialize(),
            success:function (msg) {
                if (msg == 'ok') {
                    $('.statusPenarikanMSGUpdate').html('<span style="color:green;">Data Penarikan Telah Tersimpan.</p>');
                    $('.submitPenarikanUpdate').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusPenarikanMSGUpdate').html('<span style="color:red;">Data Penarikan Gagal Tersimpan.</p>');
                } else {
                    $('.statusPenarikanMSGUpdate').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });


    }
</script>

<?php
}else {
    echo "<p>Data Error</p>";
}