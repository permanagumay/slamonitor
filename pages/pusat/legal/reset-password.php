<?php

include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idUser'])&& isset($_SESSION['nik'])){
    $idUser = $_GET['idUser'];
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Reset Password</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="statusResetMsg"></p>
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-reset-password">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="idUserReset" value="<?=$idUser?>">
                                    <button type="button" class="form-control btn btn-yahoo submitReset" onclick="sentReset()">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                Kembali/Cancel
            </button>
        </div>
    </div>
</div>
    <script>
        function sentReset() {

            $.ajax({
                type: 'post',
                url: 'pages/pusat/legal/act-reset-password.php',
                dataType: 'html',
                data:$('#form-reset-password').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.statusResetMsg').html('<span style="color:green;">Reset Password Telah Tersimpan.</p>');
                        $('.submitReset').attr("disabled", "disabled");
                    } else if (msg == 'sql') {
                        $('.statusResetMsg').html('<span style="color:red;">Reset Password Gagal Tersimpan.</p>');
                    } else {
                        $('.statusResetMsg').html('<span style="color:red;">Data Error.</p>');
                    }
                }
            });

        }
    </script>
<?php
}else {
    echo "Data Error";
}