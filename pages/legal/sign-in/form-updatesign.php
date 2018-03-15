<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idSign']) && isset($_SESSION['nik'])){
    $idInputSign = $_GET['idSign'];

    $sql = mysqli_query($Open, "select
                                        no_pk
                                        ,tgl_pengurusan
                                        ,tgl_target
                                        ,tgl_pemenuhan
                                        ,tgl_khasanah
                                        ,status
                                        ,keterangan
                                      from tb_inputsignpk where id_inputsign = '$idInputSign'");
    $result = mysqli_fetch_array($sql);

    // get current status
    $getStatus = mysqli_query($Open, "select * from master_statusprogress where id_progress = '".$result[5]."'");
?>
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Detail Sign-PK</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="signinMsgUpdate"></p>
                    <form action="#" role="form" id="form-signinUpdate" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">No. PK</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="no_pkUpdate" name="no_pkUpdate" placeholder="no. pk" value="<?=$result[0]?>">
                                    <p class="noPKMsgUpdate"></p>
                                </div>
                                <input type="hidden" name="idInputSignUpdate" value="<?=$idInputSign?>">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengurusan</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerPengurusanUpdate">
                                        <input class="form-control" name="tglPengurusanUpdate" id="tglPengurusanUpdate" placeholder="yyyy/mm/dd" value="<?=$result[1]?>" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglPengurusanMsgUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Target</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerTargetUpdate">
                                        <input class="form-control" name="tglTargetUpdate" id="tglTargetUpdate" placeholder="yyyy/mm/dd" value="<?=$result[2]?>" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglTargetMsgUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pemenuhan</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerPemenuhanUpdate">
                                        <input class="form-control" name="tglPemenuhanUpdate" id="tglPemenuhanUpdate" placeholder="yyyy/mm/dd"  value="<?=$result[3]?>"/>
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglPemenuhanMsgUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Masuk Khasanah</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerKhasanahUpdate">
                                        <input class="form-control" name="tglKhasanahUpdate" id="tglKhasanahUpdate" placeholder="yyyy/mm/dd" value="<?=$result[4]?>" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="tglKhasanahMsgUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Status Sign-in</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="status-progressUpdate" name="status-progressUpdate">
                                        <?php
                                        while($row1 = mysqli_fetch_array($getStatus)){
                                            echo '<option value="' . $row1[0] . '">' . $row1[1] . '</option>';
                                        }
                                        echo getStatusProgress(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="ket-upsign" name="ket-upsign"><?=$result[6]?></textarea>
                                    <p class="ket-upsign-status"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitSignInUpdate" onclick="sentUpdateSignIn()">Submit
            </button>
            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#datePickerPengurusanUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerTargetUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerPemenuhanUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });
        $(document).ready(function () {
            $('#datePickerKhasanahUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function sentUpdateSignIn() {
            if($('#no_pkUpdate').val().trim() == ''){
                $('.noPKMsgUpdate').html('<span style="color:red;">No. PK  Wajib Diisi.</span>');
                $('#no_pkUpdate').focus();
                return false;
            } else {
                $('.noPKMsgUpdate').html('<span style="color:red;"></span>');
            }
            if($('#tglPengurusanUpdate').val().trim() == ''){
                $('.tglPengurusanMsgUpdate').html('<span style="color:red;">Tgl. Pengurusan Wajib Diisi.</span>');
                return false;
            } else {
                $('.tglPengurusanMsgUpdate').html('<span style="color:red;"></span>');
            }
            if($('#tglTargetUpdate').val().trim() == ''){
                $('.tglTargetMsgUpdate').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                return false;
            } else {
                $('.tglTargetMsgUpdate').html('<span style="color:red;"></span>');
            }

            if($('#tglPemenuhanUpdate').val().trim() == ''){
                $('.tglPemenuhanMsgUpdate').html('<span style="color:red;">Tgl. Pemenuhan Wajib Diisi.</span>');
                return false;
            } else {
                $('.tglPemenuhanMsgUpdate').html('<span style="color:red;"></span>');
            }

            if($('#tglKhasanahUpdate').val().trim() == ''){
                $('.tglKhasanahMsgUpdate').html('<span style="color:red;">Tgl. Khasanah Wajib Diisi.</span>');
                return false;
            } else {
                $('.tglKhasanahMsgUpdate').html('<span style="color:red;"></span>');
            }

            if($('#ket-upsign').val().trim() == ''){
                $('.ket-upsign-status').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                $('#ket-upsign').focus();
                return false;
            } else {
                $('.ket-upsign-status').html('<span style="color:red;"></span>');
            }

            $.ajax({
                url:"pages/legal/sign-in/action-signinUpdate.php",
                method:"POST",
                data:$('#form-signinUpdate').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.signinMsgUpdate').html('<span style="color:green;">Data Sign PK Telah Tersimpan.</p>');
                        $('.submitSignInUpdate').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.signinMsgUpdate').html('<span style="color:red;">Data Sign PK Gagal Tersimpan.</p>');
                    } else if(msg == 'ada'){
                        $('.signinMsgUpdate').html('<span style="color:red;">Transaksi ini sudah melakukan Sign-In.</p>');
                    } else {
                        $('.signinMsgUpdate').html('<span style="color:red;">Data Error.</p>');
                    }
                }
            });
        }
    </script>
<?php
}else {
    echo "<p>Data Error</p>";
}
