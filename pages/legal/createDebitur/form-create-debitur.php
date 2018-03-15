<?php
include "assets/koneksi.php";
session_start();
?>
<div class="content">
    <ul class="breadcrumb">
        <li class="active">Input Debitur</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <p class="statusDebitur"></p>
            <form role="form" action="#" class="form-horizontal" id="form-debitur" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Cabang</label>
                        <div class="col-sm-4">
                            <input class="form-control" value="<?=getCabangInput($_SESSION['id_cabang']); ?>" name="cabang" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Marketing</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="marketing" name="marketing">
                                <?=getMarketing($_SESSION['id_cabang']); ?>
                            </select>
                            <p class="statusMarketing"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Nama Debitur</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="nama_debitur" name="nama_debitur" placeholder="nama debitur">
                            <p class="statusNamaDebitur"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">Tgl. Terima CRM</label>
                        <div class="col-sm-4">
                            <div class="input-group input-append date" id="datePickerTerimaCRM">
                                <input class="form-control" id="dateTerimaCRM" name="dateTerimaCRM" placeholder="yyyy/mm/dd"/>
                                <span class="input-group-addon add-on"><span
                                            class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <p class="statusTerimaCRM"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">CIF</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="nomor_cif" name="nomor_cif" placeholder="cif" >
                            <p class="statuscif"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">No. PPK</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="nomor_ppk" name="nomor_ppk" placeholder="no.ppk" >
                            <p class="statusppk"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left">No. CRM</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="nomor_crm" name="nomor_crm" placeholder="no.crm" >
                            <p class="statuscrm"></p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-yahoo pull-right submitDebitur" onclick="sentDebitur()">
                        Submit
                    </button>
                    <button type="button" id="btnKembaliAgunan" class="btn btn-facebook pull-right"
                            onclick="history.back()">Kembali/Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datePickerTerimaCRM').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

    });
    
    function checkLetter() {
        
    }

    function sentDebitur() {
        if($('#marketing').val()== '' || $('#marketing').val()==  null ){
            $('.statusMarketing').html('<span style="color:red;">Pilihan Nama Marketing Wajib Ada, Silahkan Hubungi Administrator.</span>');
            return false;
        } else {
            $('.statusMarketing').html('<span style="color:red;"></span>');
        }

        if ($('#nama_debitur').val().trim() == '') {
            $('.statusNamaDebitur').html('<span style="color:red;">Nama Debitur Wajib Diisi.</span>');
            $('#nama_debitur').focus();
            return false;
        } else {
            $('.statusNamaDebitur').html('<span style="color:red;"></span>');
        }

        if ($('#dateTerimaCRM').val().trim() == '') {
            $('.statusTerimaCRM').html('<span style="color:red;">Tgl. Terima CRM Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTerimaCRM').html('<span style="color:red;"></span>');
        }

        if ($('#nomor_cif').val().trim() == '') {
            $('.statuscif').html('<span style="color:red;">No. CIF Wajib Diisi.</span>');
            $('#nomor_cif').focus();
            return false;
        } else {
            $('.statuscif').html('<span style="color:red;"></span>');
        }

        if ($('#nomor_ppk').val().trim() == '') {
            $('.statusppk').html('<span style="color:red;">No. PPK Wajib Diisi.</span>');
            $('#nomor_ppk').focus();
            return false;
        } else {
            $('.statusppk').html('<span style="color:red;"></span>');
        }

        if ($('#nomor_crm').val().trim() == '') {
            $('.statuscrm').html('<span style="color:red;">No. CRM Wajib Diisi.</span>');
            $('#nomor_crm').focus();
            return false;
        } else {
            $('.statuscrm').html('<span style="color:red;"></span>');
        }




        $.ajax({
            url: "pages/legal/createDebitur/act-debitur.php",
            method: "POST",
            data: $('#form-debitur').serialize(),
            success: function (msg) {
                if (msg == 'ok') {
                    $('.statusDebitur').html('<span style="color:green;">Data Debitur Telah Tersimpan.</p>');
                    $('.submitDebitur').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusDebitur').html('<span style="color:red;">Data Debitur Gagal Tersimpan.</p>');
                }else if(msg == 'tidak sesuai'){
                    $('.statusDebitur').html('<span style="color:red;">Nama Debitur tidak sesuai dengan No. CIF.</p>');
                }else if(msg == 'PPK'){
                    $('.statusDebitur').html('<span style="color:red;">Data PPK sudah terdaftar.</p>');
                }else if(msg == 'CRM'){
                    $('.statusDebitur').html('<span style="color:red;">Data CRM sudah terdaftar.</p>');
                }else {
                    $('.statusDebitur').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });

    }
</script>