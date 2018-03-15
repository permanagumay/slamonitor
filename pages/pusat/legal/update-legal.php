<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['idUser']) && isset($_SESSION['nik'])){
    $idUser = $_GET['idUser'];
    $nik = $_SESSION['nik'];

    $sql = mysqli_query($Open, "select a.nik, a.nama, a.id_cabang, a.hak_akses, a.aktif 
                                      from user a                                      
                                      where a.id_user = '$idUser' ");
    $data = mysqli_fetch_array($sql);

    // get cabang
    $sqlCabang = mysqli_query($Open, "select * from cabang where id_cabang = '$data[2]'");
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Update Legal</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="statusLegalMsgUpdate"></p>
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-legal-Update">
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
                                        <input type="text" id="nik-legalUpdate" name="nik-legalUpdate" class="form-control" placeholder="nik" value="<?=$data[0]?>" maxlength="8">
                                        <p class="statusNikMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="nama-legalUpdate" name="nama-legalUpdate" class="form-control" value="<?=$data[1]?>" placeholder="nama">
                                        <p class="statusNamaMsgUpdate"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Hak-Akses</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="selectHakAksesUpdate" name="selectHakAksesUpdate">
                                            <?php
                                                if($data[3] == 3){
                                                    echo "<option value='3'>User</option>";
                                                }else{
                                                    echo "<option value='2'>Administrator</option>";
                                                }
                                            ?>
                                            <option value="2">Administrator</option>
                                            <option value="3">User</option>
                                        </select>
                                        <input type="hidden"  name="idUser" value="<?=$idUser?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align: left">Status-Aktif</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="status-aktif" name="status-aktif">
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
                                        <input type="hidden"  name="idUser" value="<?=$idUser?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-yahoo pull-right submitLegalUpdate" onclick="sentLegalUpdate()">
                Submit
            </button>
            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                Kembali/Cancel
            </button>
        </div>
    </div>
</div>
<script>
    function sentLegalUpdate() {
        if($('#selectHakAksesUpdate').val() == 2){
            if($('#selectCabangUpdate').val() != 1){
                $('.statusCabangMsgUpdate').html('<span style="color:red;">Hak Akses Administrator hanya untuk Cabang PT Bank Agris.</span>');
                return false;
            }else {
                $('.statusCabangMsgUpdate').html('<span style="color:red;"></span>');
            }
        }

        if($('#nik-legalUpdate').val().trim() == ''){
            $('.statusNikMsgUpdate').html('<span style="color:red;">NIK wajib di isi.</span>');
            return false;
        }else {
            $('.statusNikMsgUpdate').html('<span style="color:red;"></span>');
        }

        if($('#nama-legalUpdate').val().trim() == ''){
            $('.statusNamaMsgUpdate').html('<span style="color:red;">Nama wajib di isi.</span>');
            return false;
        }else {
            $('.statusNamaMsgUpdate').html('<span style="color:red;"></span>');
        }

        $.ajax({
            type: 'post',
            url: 'pages/pusat/legal/act-update-legal.php',
            dataType: 'html',
            data:$('#form-legal-Update').serialize(),
            success: function (msg) {
                if (msg == 'ok') {
                    $('.statusLegalMsgUpdate').html('<span style="color:green;">Data Legal Telah Tersimpan.</p>');
                    $('.submitLegalUpdate').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusLegalMsgUpdate').html('<span style="color:red;">Data Legal Gagal Tersimpan.</p>');
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