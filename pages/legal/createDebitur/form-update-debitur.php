<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idCrm']) && $_SESSION['nik']){
    $idCrm = $_GET['idCrm'];
    $sql = mysqli_query($Open, "select
                                        a.nama_debitur
                                        ,a.cabang
                                        ,a.nik_marketing
                                        ,a.tgl_terimacrm
                                        ,a.cif
                                        ,a.ppk
                                        ,a.crm
                                      from tb_inputcrm a   
                                      where a.id_crm = '$idCrm'");
    $result = mysqli_fetch_array($sql);

    // get marketing
    $sqlUser = mysqli_query($Open, "select * from master_marketing where nik_marketing = '$result[2]'");
    $resultUser = mysqli_fetch_array($sqlUser);

?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
        <h4><b>Update Debitur</b></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p class="statusDebiturUpdate"></p>
                <form role="form" action="#" class="form-horizontal" id="form-update-debitur" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">Cabang</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" value="<?=$result[1] ?>"  name="cabangUpdate" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">Marketing</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="marketingUpdate" name="marketingUpdate">
                                    <?php
                                        echo "<option value='$resultUser[0]'>$resultUser[2]</option>";
                                     echo getMarketing($_SESSION['id_cabang']); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">Nama Debitur</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="nama_debiturUpdate" name="nama_debiturUpdate" placeholder="nama debitur" value="<?=$result[0]?>">
                                <p class="statusNamaDebiturUpdate"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">Tgl. Terima CRM</label>
                            <div class="col-sm-8">
                                <div class="input-group input-append date" id="datePickerTerimaCRMUpdate">
                                    <input class="form-control" id="dateTerimaCRMUpdate" name="dateTerimaCRMUpdate" placeholder="yyyy/mm/dd" value="<?=$result[3]?>"/>
                                    <span class="input-group-addon add-on"><span
                                            class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <p class="statusTerimaCRMUpdate"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">CIF</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="nomor_cifUpdate" name="nomor_cifUpdate" placeholder="cif" value="<?=$result[4]?>">
                                <p class="statuscifUpdate"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">No. PPK</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="nomor_ppkUpdate" name="nomor_ppkUpdate" placeholder="no.ppk" value="<?=$result[5]?>">
                                <p class="statusppkUpdate"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left">No. CRM</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="nomor_crmUpdate" name="nomor_crmUpdate" placeholder="no.crm" value="<?=$result[6]?>">
                                <p class="statuscrmUpdate"></p>
                            </div>
                            <input type="hidden" name="idCrmDebiturUpdate" value="<?=$idCrm?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-yahoo pull-right submitDebiturUpdate" onclick="sentDebiturUpdate()">
            Submit
        </button>
        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
            Kembali/Cancel
        </button>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datePickerTerimaCRMUpdate').datepicker({
                autoclose: true,
                format: 'yyyy/mm/dd'
            });

        });

        function sentDebiturUpdate() {
            console.log($('#marketingUpdate').val());

            if ($('#nama_debiturUpdate').val().trim() == '') {
                $('.statusNamaDebiturUpdate').html('<span style="color:red;">Nama Debitur Wajib Diisi.</span>');
                $('#nama_debiturUpdate').focus();
                return false;
            } else {
                $('.statusNamaDebiturUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#dateTerimaCRMUpdate').val().trim() == '') {
                $('.statusTerimaCRMUpdate').html('<span style="color:red;">Tgl. Terima CRM Wajib Diisi.</span>');
                return false;
            } else {
                $('.statusTerimaCRMUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#nomor_cifUpdate').val().trim() == '') {
                $('.statuscifUpdate').html('<span style="color:red;">No. CIF Wajib Diisi.</span>');
                $('#nomor_cifUpdate').focus();
                return false;
            } else {
                $('.statuscifUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#nomor_ppkUpdate').val().trim() == '') {
                $('.statusppkUpdate').html('<span style="color:red;">No. PPK Wajib Diisi.</span>');
                $('#nomor_ppkUpdate').focus();
                return false;
            } else {
                $('.statusppkUpdate').html('<span style="color:red;"></span>');
            }

            if ($('#nomor_crmUpdate').val().trim() == '') {
                $('.statuscrmUpdate').html('<span style="color:red;">No. CRM Wajib Diisi.</span>');
                $('#nomor_crmUpdate').focus();
                return false;
            } else {
                $('.statuscrmUpdate').html('<span style="color:red;"></span>');
            }

            $.ajax({
                url: "pages/legal/createDebitur/act-update-debitur.php",
                method: "POST",
                data: $('#form-update-debitur').serialize(),
                success: function (msg) {
                    if (msg == 'ok') {
                        $('.statusDebiturUpdate').html('<span style="color:green;">Data Debitur Telah Tersimpan.</p>');
                        $('.submitDebiturUpdate').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    } else if (msg == 'sql') {
                        $('.statusDebiturUpdate').html('<span style="color:red;">Data Debitur Gagal Tersimpan.</p>');
                    } else if(msg== 'PPK'){
                        $('.statusDebiturUpdate').html('<span style="color:red;">Data PPK sudah terdaftar.</p>');
                    }else if(msg== 'CRM'){
                        $('.statusDebiturUpdate').html('<span style="color:red;">Data CRM sudah terdaftar.</p>');
                    }else if(msg== 'No'){
                        $('.statusDebiturUpdate').html('<span style="color:red;">Test</p>');
                    }else {
                        $('.statusDebiturUpdate').html('<span style="color:red;">Data Error.</p>');
                    }
                }

            });

        }
    </script>
<?php
}else {
    echo "<p>Data Error</p>";
}