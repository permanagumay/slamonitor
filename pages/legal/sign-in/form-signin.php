<?php
include "assets/koneksi.php";
session_start();
if(isset($_GET['idCrm']) && isset($_SESSION['nik'])){
    $idCrm = $_GET['idCrm'];
?>
<div class="content">
    <ul class="breadcrumb">
        <li class="active">Input Sign PK</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <p class="signinMsg"></p>
            <form action="#" role="form" id="form-signin" class="form-horizontal" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">No. PK</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="no_pk" name="no_pk" placeholder="no. pk">
                            <p class="noPKMsg"></p>
                        </div>
                        <input type="hidden" name="idCrm" value="<?=$idCrm?>">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Tgl. Pengurusan</label>
                        <div class="col-sm-4">
                            <div class="input-group input-append date" id="datePickerPengurusan">
                                <input class="form-control" name="tglPengurusan" id="tglPengurusan" placeholder="yyyy/mm/dd" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <p class="tglPengurusanMsg"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Tgl. Target</label>
                        <div class="col-sm-4">
                            <div class="input-group input-append date" id="datePickerTarget">
                                <input class="form-control" name="tglTarget" id="tglTarget" placeholder="yyyy/mm/dd" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <p class="tglTargetMsg"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Tgl. Pemenuhan</label>
                        <div class="col-sm-4">
                            <div class="input-group input-append date" id="datePickerPemenuhan">
                                <input class="form-control" name="tglPemenuhan" id="tglPemenuhan" placeholder="yyyy/mm/dd" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <p class="tglPemenuhanMsg"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Tgl. Masuk Khasanah</label>
                        <div class="col-sm-4">
                            <div class="input-group input-append date" id="datePickerKhasanah">
                                <input class="form-control" name="tglKhasanah" id="tglKhasanah" placeholder="yyyy/mm/dd" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <p class="tglKhasanahMsg"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Status Sign-in</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="status-progress" name="status-progress">
                                <?=getStatusProgress(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Keterangan</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" id="keterangan-sign" name="keterangan-sign"></textarea>
                            <p class="ketSign"></p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-yahoo pull-right submitSignIn" onclick="sentSignIn()">Submit
                    </button>
                    <button type="button" class="btn btn-facebook pull-right" onclick=location.href='javascript:history.back()'>Kembali/Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        $(document).ready(function () {
            $('#datePickerPengurusan').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerTarget').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerPemenuhan').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerKhasanah').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function sentSignIn() {
            if($('#status-progress').val() == 1 ){
                if($('#no_pk').val().trim() == ''){
                    $('.noPKMsg').html('<span style="color:red;">No. PK  Wajib Diisi.</span>');
                    $('#no_pk').focus();
                    return false;
                } else {
                    $('.noPKMsg').html('<span style="color:red;"></span>');
                }
                if($('#tglPengurusan').val().trim() == ''){
                    $('.tglPengurusanMsg').html('<span style="color:red;">Tgl. Pengurusan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglPengurusanMsg').html('<span style="color:red;"></span>');
                }
                if($('#tglTarget').val().trim() == ''){
                    $('.tglTargetMsg').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglTargetMsg').html('<span style="color:red;"></span>');
                }

                if($('#tglPemenuhan').val().trim() == ''){
                    $('.tglPemenuhanMsg').html('<span style="color:red;">Tgl. Pemenuhan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglPemenuhanMsg').html('<span style="color:red;"></span>');
                }

                if($('#tglKhasanah').val().trim() == ''){
                    $('.tglKhasanahMsg').html('<span style="color:red;">Tgl. Khasanah Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglKhasanahMsg').html('<span style="color:red;"></span>');
                }

                if($('#keterangan-sign').val().trim() == ''){
                    $('.ketSign').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.ketSign').html('<span style="color:red;"></span>');
                }



            }else {
                if($('#no_pk').val().trim() == ''){
                    $('.noPKMsg').html('<span style="color:red;">No. PK  Wajib Diisi.</span>');
                    $('#no_pk').focus();
                    return false;
                } else {
                    $('.noPKMsg').html('<span style="color:red;"></span>');
                }
                if($('#tglPengurusan').val().trim() == ''){
                    $('.tglPengurusanMsg').html('<span style="color:red;">Tgl. Pengurusan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglPengurusanMsg').html('<span style="color:red;"></span>');
                }
                if($('#tglTarget').val().trim() == ''){
                    $('.tglTargetMsg').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglTargetMsg').html('<span style="color:red;"></span>');
                }

                if($('#tglKhasanah').val().trim() == ''){
                    $('.tglKhasanahMsg').html('<span style="color:red;">Tgl. Khasanah Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglKhasanahMsg').html('<span style="color:red;"></span>');
                }

                if($('#keterangan-sign').val().trim() == ''){
                    $('.ketSign').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.ketSign').html('<span style="color:red;"></span>');
                }

            }


            $.ajax({
                url:"pages/legal/sign-in/action-signin.php",
                method:"POST",
                data:$('#form-signin').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.signinMsg').html('<span style="color:green;">Data Sign PK Telah Tersimpan.</p>');
                        $('.submitSignIn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.signinMsg').html('<span style="color:red;">Data Sign PK Gagal Tersimpan.</p>');
                    } else if(msg == 'ada'){
                        $('.signinMsg').html('<span style="color:red;">Transaksi ini sudah melakukan Sign-In.</p>');
                    } else {
                        $('.signinMsg').html('<span style="color:red;">Data Error.</p>');
                    }
                }
            });
        }
    </script>
<?php
}else {
    echo "Data Error";
}