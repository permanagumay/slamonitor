<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['id_inputdeviasi']) && isset($_SESSION['nik'])) {

    $idInputDeviasi = $_GET['id_inputdeviasi'];

    $sql = mysqli_query($Open, "select * from tb_inputdeviasi where id_inputdeviasi ='$idInputDeviasi'");
    $result = mysqli_fetch_array($sql);

    $sqlMasterDeviasi = mysqli_query($Open, "select * from master_deviasi where id_masterdeviasi = '$result[2]'")


?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ccccff">
                <h4><b>Update Deviasi</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="#" class="form-horizontal"  id="form-UpdateDeviasi" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <p class="deviasiUpdateStatus"></p>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" style="text-align: left">Deviasi</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectUpdateDeviasi" name="selectUpdateDeviasi"  onchange="showUpdateDeviasiLainnya()">
                                                <?php
                                                while($row = mysqli_fetch_array($sqlMasterDeviasi)){
                                                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                                    $no++;
                                                }
                                                ?>
                                                <?php echo getMasterDeviasiCombo(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divUpdateDeviasiLainnya">
                                        <label class="col-sm-4 control-label"  style="text-align: left"></label>
                                        <div class="col-sm-8">
                                            <input class="form-control inputUpdateDeviasi" id="updateDeviasiLainnya" name="UpdateDeviasiLainnya" placeholder="deviasi lainnya" value="<?=$result[3]?>">
                                            <p class="updateDeviasiLainnyaStatus"></p>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divTglMulaiDeviasi">
                                        <label class="col-sm-4 control-label" style="text-align: left">Tgl. Mulai</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerTglMulaiUpdateDeviasi">
                                                <input class="form-control" id="TglMulaiUpdateDeviasi" name="TglMulaiUpdateDeviasi" placeholder="yyyy/mm/dd"  value="<?=$result[4]?>" required/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="updateDeviasiTglMulaiStatus"></p>
                                        </div>
                                    </div>
                                    <div class="form-group" id="divTglTargetDeviasi">
                                        <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-append date" id="datePickerTglTargetUpdateDeviasi">
                                                <input class="form-control" id="TglTargetUpdateDeviasi" name="TglTargetUpdateDeviasi" placeholder="yyyy/mm/dd" value="<?=$result[5]?>" required/>
                                                <span class="input-group-addon add-on"><span  class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <p class="updateDeviasiTglTargetStatus"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"  style="text-align: left">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="keteranganUpdateDeviasi" name="keteranganUpdateDeviasi" placeholder="keterangan" required><?=$result[8]?></textarea>
                                            <p class="deviasiUpdateKeteranganStatus"></p>
                                            <input type="hidden" name="idInputUpdateDev" value="<?=$idInputDeviasi?>">
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


            $('#datePickerTglMulaiUpdateDeviasi').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerTglTargetUpdateDeviasi').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });

        function showUpdateDeviasiLainnya() {

            var selectUpdateDeviasiLain = document.getElementById("selectUpdateDeviasi").value;
            if (selectUpdateDeviasiLain == 6) {
                document.getElementById("divUpdateDeviasiLainnya").style.display = '';
            } else {
                document.getElementById("divUpdateDeviasiLainnya").style.display = 'none';
            }
        }

        function sentUpdateDeviasiForm() {
            if ($('#selectUpdateDeviasi').val() == 6) {
                if ($('#updateDeviasiLainnya').val().trim() == '') {
                    $('.updateDeviasiLainnyaStatus').html('<span style="color:red;">Deviasi Lain Wajib Diisi.</span>');
                    $('#deviasiLainnya').focus();
                    return false;
                }else {
                    $('.updateDeviasiLainnyaStatus').html('<span style="color:red;"></span>');
                }
            }

            if ($('#TglMulaiUpdateDeviasi').val().trim() == '') {
                $('.updateDeviasiTglMulaiStatus').html('<span style="color:red;">Tgl. Mulai Wajib Diisi.</span>');
                return false;
            }else {
                $('.updateDeviasiTglMulaiStatus').html('<span style="color:red;"></span>');
            }

            if ($('#TglTargetUpdateDeviasi').val().trim() == '') {
                $('.updateDeviasiTglTargetStatus').html('<span style="color:red;">Tgl. Target Wajib Diisi.</span>');
                return false;
            }else {
                $('.updateDeviasiTglTargetStatus').html('<span style="color:red;"></span>');
            }

            if ($('#keteranganUpdateDeviasi').val().trim() == '') {
                $('.deviasiUpdateKeteranganStatus').html('<span style="color:red;">Keterangan Wajib Diisi.</span>');
                $('#keteranganUpdateDeviasi').focus();
                return false;
            }else {
                $('.deviasiUpdateKeteranganStatus').html('<span style="color:red;"></span>');
            }

            $.ajax({
                type: 'post',
                url: 'pages/legal/pendingList/action-updatedeviasi.php',
                dataType: 'html',
                data:$('#form-UpdateDeviasi').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.deviasiUpdateStatus').html('<span style="color:green;">Data Deviasi Telah Tersimpan.</p>');
                        $('.submitUpdateDeviasiBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    }else if(msg == 'sql') {
                        $('.deviasiUpdateStatus').html('<span style="color:red;">Data Deviasi Gagal Tersimpan.</p>');
                    }else {
                        $('.deviasiUpdateStatus').html('<span style="color:red;">Data Error.</p>');
                    }

                }

            });
        }
    </script>

<?php
} else {
    echo "<p>Data Error</p>";
}