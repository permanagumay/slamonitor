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
                                      from tb_inputcovenant a where a.id_input_covenant = '$idInputCovenant'");
    $result = mysqli_fetch_array($sql);

    $sqlMasterCovenant = mysqli_query($Open, "select * from master_syaratcovenant where id_syarat = '$result[0]'");
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
        <h4><b>Update Covenant</b></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p class="updateCovenantStatus"></p>
                <form role="form" action="#" id="form-updatecovenant" class="form-horizontal" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="col-md-12">
                            <input type="hidden" value="<?=$result[4]?>" name="idInputCovenantUpdate">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Syarat/Kewajiban</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectUpdateCovenant" name="selectUpdateCovenant" onchange="showUpdateCovenantLainnya()">
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
                                        <textarea class="form-control" id="updateCovenantLainnya" name="updateCovenantLainnya" placeholder="covenant lainnya"><?=$result[1]?></textarea>
                                        <p class="updateCovenantLainnyaStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group" id="divTglMulaiCovenant">
                                    <label class="col-sm-4 control-label" style="text-align: left">Tgl.Mulai</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglMulaiUpdateCovenant">
                                            <input class="form-control" id="TglMulaiUpdateCovenant" name="TglMulaiUpdateCovenant" placeholder="yyyy/mm/dd" value="<?=$result[2]?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="updateTglMulaiStatus"></p>
                                    </div>
                                </div>
                                <div class="form-group" id="divTglTargetCovenant">
                                    <label class="col-sm-4 control-label" style="text-align: left">Target Date</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-append date" id="datePickerTglTargetUpdateCovenant">
                                            <input class="form-control" id="TglTargetUpdateCovenant" name="TglTargetUpdateCovenant" placeholder="yyyy/mm/dd" value="<?=$result[3]?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <p class="updateTglTargetStatus"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-yahoo pull-right submitCovenantBtn" onclick="sentUpdateCovenantForm()">
            Submit
        </button>
        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
            Kembali/Cancel
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

            $('#datePickerTglMulaiUpdateCovenant').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
            $('#datePickerTglTargetUpdateCovenant').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });
        });


        function showUpdateCovenantLainnya() {
            var selectCovenant = $('#selectUpdateCovenant').val();
            if(selectCovenant == 5){
                document.getElementById("divUpdateCovenantLainnya").style.display = '';
            }else{
                document.getElementById("divUpdateCovenantLainnya").style.display = 'none';
            }
        }

        function sentUpdateCovenantForm() {
            if($('#selectUpdateCovenant').val() == 5){
                if($('#updateCovenantLainnya').val().trim() == ''){
                    $('.updateCovenantLainnyaStatus').html('<span style="color:red;">Covenant Lain Wajib Diisi.</span>');
                    $('#updateCovenantLainnya').focus();
                    return false;
                }else {
                    $('.updateCovenantLainnyaStatus').html('<span style="color:red;"></span>');
                }
            }

            $.ajax({
                type: 'post',
                url: 'pages/legal/pendingList/action-updatecovenant.php',
                dataType: 'html',
                data:$('#form-updatecovenant').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.updateCovenantStatus').html('<span style="color:green;">Data Covenant Telah Tersimpan.</p>');
                        $('.submitCovenantBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    }else if(msg == 'sql') {
                        $('.updateCovenantStatus').html('<span style="color:red;">Data Covenant Gagal Tersimpan.</p>');
                    }else {
                        $('.updateCovenantStatus').html('<span style="color:red;">Data Error</p>');
                    }

                }

            });
        }
    </script>



    <?php
}else {
    echo "<p>Data Error</p>";
}