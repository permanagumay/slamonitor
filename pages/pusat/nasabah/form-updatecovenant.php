<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idInputCovenant']) && isset($_SESSION['nik'])){

    $idInputCovenant = $_GET['idInputCovenant'];


    $sql = mysqli_query($Open, "select  
                                        a.id_syarat                                        
                                        ,a.syarat_lainnya
                                        ,a.tgl_mulai
                                        ,a.tgl_target
                                        ,a.id_input_covenant
                                        ,a.status_progress
                                        ,a.tgl_pemenuhan
                                      from tb_inputcovenant a where a.id_input_covenant = '$idInputCovenant'");
    $result = mysqli_fetch_array($sql);
    // get current status progress
    $sqlProgress = mysqli_query($Open, "select * from master_statusprogress where id_progress = $result[5]");

    $sqlMasterCovenant = mysqli_query($Open, "select * from master_syaratcovenant where id_syarat = '$result[0]'");

    if($result[6] == '0000-00-00'){
        $tglPemenuhan = '';
    }else {
        $tglPemenuhan = $result[6];
    }
    ?>

    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Detail Covenant</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="updateCovenantStatus"></p>
                    <form role="form" action="#" class="form-horizontal" enctype="multipart/form-data" id="form-updateCovenant">
                        <div class="box-body">
                            <div class="col-md-12">
                                <input type="hidden" value="<?=$idInputCovenant?>" id="idInputCovenant" name="idInputCovenant">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Syarat/Kewajiban</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectUpdateCovenant" name="selectUpdateCovenant" onchange="showUpdateCovenantLainnya()" disabled="disabled">
                                            <?php
                                            while($row = mysqli_fetch_array($sqlMasterCovenant)){
                                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                            }
                                            echo getMasterCovenantCombo(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="divUpdateCovenantLainnya">
                                    <label class="col-sm-4 control-label" style="text-align: left"></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="updateCovenantLainnya" name="updateCovenantLainnya" placeholder="covenant lainnya" ><?=$result[1]?></textarea>
                                        <p class="updateCovenantLainnyaStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group" id="divTglMulaiCovenant">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglMulaiUpdateCovenant">
                                            <input class="form-control" id="TglMulaiUpdateCovenant" name="TglMulaiUpdateCovenant" placeholder="yyyy/mm/dd" value="<?=$result[2]?>" disabled="disabled"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="updateTglMulaiStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group" id="divTglTargetCovenant">
                                    <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglTargetUpdateCovenant">
                                            <input class="form-control" id="TglTargetUpdateCovenant" name="TglTargetUpdateCovenant" placeholder="yyyy/mm/dd" value="<?=$result[3]?>" disabled="disabled"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="updateTglTargetStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group" id="divTglPenyelesaianCovenant">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl. Penyelesaian</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglPenyelesaianUpdateCovenant">
                                            <input class="form-control" id="TglPenyelesaianUpdateCovenant" name="TglPenyelesaianUpdateCovenant" placeholder="yyyy/mm/dd" value="<?=$tglPemenuhan?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="updateTglPenyelesaianStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Status Covenant</label>
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
            <button type="button" class="btn btn-yahoo pull-right submitCovenantBtn" onclick="sentUpdateCovenantForm()">Submit
            </button>
            <button type="button" id="btnKembali" class="btn btn-instagram pull-right submitCovenantKembali" onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var selectCovenant = $('#selectUpdateCovenant').val();
            if(selectCovenant == 5){
                document.getElementById("divUpdateCovenantLainnya").style.display = '';
            }else{
                document.getElementById("divUpdateCovenantLainnya").style.display = 'none';
            }

            $('#datePickerTglPenyelesaianUpdateCovenant').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function sentUpdateCovenantForm() {
            console.log($('#status-progressUpdate').val());
            if($('#status-progressUpdate').val() == 1){

                if($('#TglPenyelesaianUpdateCovenant').val().trim() == ''){
                    $('.updateTglPenyelesaianStatus').html('<span style="color:red;">Tgl. Penyelesaian Wajib Diisi.</span>');
                    return false;
                } else {
                    $('.updateTglPenyelesaianStatus').html('<span style="color:red;"></span>');
                }
            }

            $.ajax({
                url:"pages/pusat/nasabah/action-updatecovenant.php",
                method:"POST",
                data:$('#form-updateCovenant').serialize(),
                success:function (msg) {
                    if (msg == 'ok') {
                        $('.updateCovenantStatus').html('<span style="color:green;">Data Covenant Telah Tersimpan.</p>');
                        $('.submitCovenantBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.updateCovenantStatus').html('<span style="color:red;">Data Covenant Gagal Tersimpan.</p>');
                    } else {
                        $('.updateCovenantStatus').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });
        }
    </script>



    <?php
}else {
    echo "<p>Data Error</p>";
}