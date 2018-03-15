<?php
include "../../../assets/koneksi.php";
session_start();
if(isset($_GET['id_inputcovnote'])&& isset($_SESSION['nik'])){
    $idInputCovNote = $_GET['id_inputcovnote'];
    $sql = mysqli_query($Open, "select * from tb_inputcovernote where id_inputcovertnote = '$idInputCovNote'");
    $result = mysqli_fetch_array($sql);

    $getJenisPengikatan = mysqli_query($Open, "select * from master_pengikatan where id_pengikatan = '$result[3]'");
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #ccccff">
        <h4><b>Update Covernote</b></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p class="statusCovernoteMSGUpdate"></p>
                <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-updatecovernote">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Pengikatan</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerPengikatanUpdate">
                                        <input class="form-control" id="tglPengikatanUpdate" name="tglPengikatanCovernoteUpdate" value="<?=$result[2]?>" placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="idInputCovNote" name="idInputCovNote" value="<?=$idInputCovNote?>">
                                    <p class="statusTglPengikatanUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Jenis Pengikatan</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectPengikatanNotarisUpdate" name="selectPengikatanNotarisUpdate" onchange="showNotaris();">
                                        <?php
                                            while($row = mysqli_fetch_array($getJenisPengikatan)){
                                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                            }
                                            echo getMasterPengikatanNotaris();?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divNamaNotarisUpdate">
                                <label class="col-sm-4 control-label" style="text-align: left">Nama Notaris</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="namaNotarisUpdate" name="namaNotarisUpdate" placeholder="nama notaris" value="<?=$result[4]?>">
                                    <p class="statusNamaNotarisUpdate"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"style="text-align: left">No. Covernote</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="noCovernoteUpdate" name="noCovernoteUpdate" value="<?=$result[5]?>" placeholder="no. covernotes">
                                    <p class="statusNoCovernoteUpdate"></p>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="text-align: left">Tgl. Covernote</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append date" id="datePickerCovernoteUpdate">
                                        <input class="form-control" id="tglCovernoteUpdate" value="<?=$result[6]?>" name="tglCovernoteUpdate" placeholder="yyyy/mm/dd"/>
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <p class="statusTglCovernoteUpdate"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-yahoo pull-right submitUpdateCovernote" onclick="sentUpdateCovernote()">Submit
        </button>
        <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">Kembali/Cancel
        </button>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#datePickerPengikatanUpdate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $('#datePickerCovernoteUpdate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

        if ($('#selectPengikatanNotarisUpdate').val() == 1) {
            document.getElementById("divNamaNotarisUpdate").style.display = '';
        } else {
            document.getElementById("divNamaNotarisUpdate").style.display = 'none';
        }
    });

    function showNotaris() {
        if ($('#selectPengikatanNotarisUpdate').val() == 1) {
            document.getElementById("divNamaNotarisUpdate").style.display = '';
        } else {
            document.getElementById("divNamaNotarisUpdate").style.display = 'none';
        }
    }

    function sentUpdateCovernote() {
        if($('#tglPengikatanUpdate').val().trim()==''){
            $('.statusTglPengikatanUpdate').html('<span style="color:red;">Tgl. Pengikatan Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglPengikatanUpdate').html('<span style="color:red;"></span>');
        }

        if($('#selectPengikatanNotarisUpdate').val()==1){
            if($('#namaNotarisUpdate').val().trim()==''){
                $('.statusNamaNotarisUpdate').html('<span style="color:red;">Nama Notaris Wajib Diisi.</span>');
                $('#namaNotarisUpdate').focus();
                return false;
            } else {
                $('.statusNamaNotarisUpdate').html('<span style="color:red;"></span>');
            }
        }else{
            $('.statusNamaNotarisUpdate').html('<span style="color:red;"></span>');
        }

        if($('#noCovernoteUpdate').val().trim()==''){
            $('.statusNoCovernoteUpdate').html('<span style="color:red;">No. Covernote Wajib Diisi.</span>');
            $('#noCovernoteUpdate').focus();
            return false;
        } else {
            $('.statusNoCovernoteUpdate').html('<span style="color:red;"></span>');
        }

        if($('#tglCovernoteUpdate').val().trim()==''){
            $('.statusTglCovernoteUpdate').html('<span style="color:red;">Tgl. Covernote Wajib Diisi.</span>');
            return false;
        } else {
            $('.statusTglCovernoteUpdate').html('<span style="color:red;"></span>');
        }


        $.ajax({
            url:"pages/legal/pendingList/action-updatecovernote.php",
            method:"POST",
            data:$('#form-updatecovernote').serialize(),
            success:function (msg) {
                if (msg == 'ok') {
                    $('.statusCovernoteMSGUpdate').html('<span style="color:green;">Data Covernote Telah Tersimpan.</p>');
                    $('.submitUpdateCovernote').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusCovernoteMSGUpdate').html('<span style="color:red;">Data Covernote Gagal Tersimpan.</p>');
                } else {
                    $('.statusCovernoteMSGUpdate').html('<span style="color:red;">Data Error.</p>');
                }
            }

        });
    }
</script>

<?php
}else {
    echo "<p>Data Error</p>";
}