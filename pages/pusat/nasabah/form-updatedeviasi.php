<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['id_inputdeviasi']) && isset($_SESSION['nik'])) {

    $idInputDeviasi = $_GET['id_inputdeviasi'];

    $sql = mysqli_query($Open, "select * from tb_inputdeviasi where id_inputdeviasi ='$idInputDeviasi'");
    $result = mysqli_fetch_array($sql);

    $sqlMasterDeviasi = mysqli_query($Open, "select * from master_deviasi where id_masterdeviasi = '$result[2]'");

    // get current status progress
    $sqlProgress = mysqli_query($Open, "select * from master_statusprogress where id_progress = $result[7]");


    if($result[4] == '0000-00-00'){
        $tglPengurusan = '';
    }else {
        $tglPengurusan = $result[4];
    }
    if($result[5] == '0000-00-00'){
        $tglTarget = '';
    }else {
        $tglTarget = $result[5];
    }
    if($result[6] == '0000-00-00'){
        $tglPemenuhan = '';
    }else {
        $tglPemenuhan = $result[6];
    }


    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ccccff">
                <h4><b>Update Deviasi</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="#" class="form-horizontal formUpdateDeviasi"  id="form-updatedeviasi" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <p class="deviasiUpdateStatus"></p>
                                    <input type="hidden" id="idInputDeviasi" name="idInputDeviasi" value="<?=$idInputDeviasi?>">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Deviasi</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdateDeviasi" name="selectUpdateDeviasi"  onchange="showUpdateDeviasiLainnya()" disabled="disabled">
                                                <?php
                                                while($row = mysqli_fetch_array($sqlMasterDeviasi)){
                                                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                                }
                                                ?>
                                                <?php echo getMasterDeviasiCombo(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdateDeviasiLainnya">
                                        <label class="col-sm-4 control-label"  style="text-align: left"></label>
                                        <div class="col-sm-8">
                                            <input class="form-control inputUpdateDeviasi" id="updateDeviasiLainnya" name="UpdateDeviasiLainnya" placeholder="deviasi lainnya" value="<?=$result[3]?>" readonly="readonly">
                                            <p class="updateDeviasiLainnyaStatus"></p>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divTglMulaiDeviasi">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Mulai</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerTglMulaiUpdateDeviasi">
                                                <input class="form-control" id="TglMulaiUpdateDeviasi" name="TglMulaiUpdateDeviasi" placeholder="yyyy/mm/dd"  value="<?=$tglPengurusan?>" disabled="disabled"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divTglTargetDeviasi">
                                        <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerTglTargetUpdateDeviasi">
                                                <input class="form-control" id="TglTargetUpdateDeviasi" name="TglTargetUpdateDeviasi" placeholder="yyyy/mm/dd" value="<?=$tglTarget?>" disabled="disabled"/>
                                                <span class="input-group-addon add-on"><span  class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"  style="text-align: left">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="keteranganUpdateDeviasi" name="keteranganUpdateDeviasi" placeholder="keterangan" readonly="readonly"><?=$result[8]?></textarea>
                                            <p class="deviasiUpdateKeteranganStatus"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pemenuhan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerTglPemenuhanDevUpdate">
                                                <input class="form-control" id="TglPemenuhanDevUpdate" name="TglPemenuhanDevUpdate" placeholder="yyyy/mm/dd" value="<?=$tglPemenuhan?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="tglSelesaiDevStatusUpdate"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Status Deviasi</label>
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
                <button type="button" class="btn btn-yahoo pull-right submitUpdateDeviasiBtn" onclick="sentUpdateDeviasiForm()">Submit</button>
                <button type="button" id="btnKembaliUpdateDeviasi" class="btn btn-facebook pull-right submitUpdateDeviasiKembali" onclick="window.location.reload()">Kembali/Cancel</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            if($('#selectUpdateDeviasi').val() == 6){
                document.getElementById("divUpdateDeviasiLainnya").style.display = '';
            }else {
                document.getElementById("divUpdateDeviasiLainnya").style.display = 'none';
            }

            $('#datePickerTglPemenuhanDevUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });



        function sentUpdateDeviasiForm() {
            console.log($('#status-progressUpdate').val());
            if($('#status-progressUpdate').val() == 1){

                if($('#TglPemenuhanDevUpdate').val().trim() == ''){
                    $('.tglSelesaiDevStatusUpdate').html('<span style="color:red;">Tgl. Penyelesaian Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.tglSelesaiDevStatusUpdate').html('<span style="color:red;"></span>');
                }
            }
            $.ajax({
                type: 'post',
                url: 'pages/pusat/nasabah/action-updatedeviasi.php',
                dataType: 'html',
                data:$('#form-updatedeviasi').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.deviasiUpdateStatus').html('<span style="color:green;">Data Deviasi Telah Tersimpan.</p>');
                        $('.submitUpdateDeviasiBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    }else if(msg == 'sql') {
                        $('.deviasiUpdateStatus').html('<span style="color:red;">Data Deviasi Gagal Tersimpan.</p>');
                    }else {
                        $('.deviasiUpdateStatus').html('<span style="color:red;">Data Error, please ask your administrator.</p>');
                    }

                }

            });
        }
    </script>

    <?php
} else {
    echo "<p>Data Error</p>";
}