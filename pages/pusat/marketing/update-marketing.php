<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idMarketing'])&& isset($_SESSION['nik'])){
    $idMarketing = $_GET['idMarketing'];

    $sql = mysqli_query($Open, "select
                                          nik_marketing
                                          ,nama_marketing
                                          ,code_ho
                                          ,id_cabang
                                          ,aktif
                                      from master_marketing where id_marketing = '$idMarketing'");
    $data = mysqli_fetch_array($sql);

    // get cabang
    $sqlCabang = mysqli_query($Open, "select * from cabang where id_cabang = '$data[3]'");

?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Update Marketing</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="statusLegalMsgUpdate"></p>
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-marketing-update">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Cabang</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectCabangUpdate" name="selectCabangUpdate">
                                            <?php
                                            while($row = mysqli_fetch_array($sqlCabang)){
                                                echo "<option value='$row[0]'>$row[2]</option>";
                                            }
                                                echo getMasterCabang(); ?>
                                        </select>
                                        <p class="statusCabangMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Nik</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nik-marketingUpdate" name="nik-marketingUpdate" class="form-control" value="<?=$data[0]?>" placeholder="nik" maxlength="8">
                                        <p class="statusNikMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nama-marketingUpdate" name="nama-marketingUpdate" value="<?=$data[1]?>" class="form-control" placeholder="nama">
                                        <p class="statusNamaMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Code-AO</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="code-hoUpdate" name="code-hoUpdate" value="<?=$data[2]?>" class="form-control" placeholder="code-ao">
                                        <p class="statusCodeHoMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Status-Aktif</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="status-aktifUpdate" name="status-aktifUpdate">
                                            <?php
                                            if($data[4] == 'Y'){
                                                echo "<option value='Y'>Aktif</option>";
                                            }else{
                                                echo "<option value='N'>Tidak-Aktif</option>";
                                            }
                                            ?>
                                            <option value="Y">Aktif</option>
                                            <option value="N">Tidak-Aktif</option>
                                        </select>
                                        <input type="hidden"  name="idMarketingUpdate" value="<?=$idMarketing?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitMarketingUpdate" onclick="sentMarketingUpdate()">
                Submit
            </button>
            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                Kembali/Cancel
            </button>
        </div>
    </div>
</div>
<script>
    function sentMarketingUpdate() {
        if($('#nik-marketingUpdate').val().trim()==''){
            $('.statusNikMsgUpdate').html('<span style="color:red;">NIK wajib di isi.</span>');
            $('#nik-marketingUpdate').focus();
            return false;
        }else {
            $('.statusNikMsgUpdate').html('<span style="color:red;"></span>');
        }
        if($('#nama-marketingUpdate').val().trim()==''){
            $('.statusNamaMsgUpdate').html('<span style="color:red;">NIK wajib di isi.</span>');
            $('#nama-marketingUpdate').focus();
            return false;
        }else {
            $('.statusNamaMsgUpdate').html('<span style="color:red;"></span>');
        }
        if($('#code-hoUpdate').val().trim()==''){
            $('.statusCodeHoMsgUpdate').html('<span style="color:red;">NIK wajib di isi.</span>');
            $('#code-hoUpdate').focus();
            return false;
        }else {
            $('.statusCodeHoMsgUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            type: 'post',
            url: 'pages/pusat/marketing/act-marketing-update.php',
            dataType: 'html',
            data:$('#form-marketing-update').serialize(),
            success: function (msg) {
                if (msg == 'ok') {
                    $('.statusLegalMsgUpdate').html('<span style="color:green;">Data Marketing Telah Tersimpan.</p>');
                    $('.submitMarketingUpdate').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusLegalMsgUpdate').html('<span style="color:red;">Data Marketing Gagal Tersimpan.</p>');
                }else if (msg == 'nik') {
                    $('.statusLegalMsgUpdate').html('<span style="color:red;">NIK Sudah Tedaftar.</p>');
                } else {
                    $('.statusLegalMsgUpdate').html('<span style="color:red;">Data Error.</p>');
                }
            }
        });
        
    }
</script>    
<?php
}else {
    echo "Data Error";
}


