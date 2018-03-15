<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['idInputFas'])) {
    $idInputFas = $_GET['idInputFas'];
    $sql = mysqli_query($Open, "select * from tb_inputcarapenarikan where id_inputfasilitas = '".$idInputFas."'");

?>
<div class="modal-content">
        <div class="modal-header" style="background-color: #ccccff">
            <h4><b>Cara Penarikan </b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">
                        <button class="btn btn-yahoo btn-large" data-toggle="modal" data-target="#modalAddPen">
                            Tambah Penarikan.
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box box-info">
                            <div class="box-body">
                                <table id="tablePenarikan1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Penarikan</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $no = 0;
                                        while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center"><?= $no + 1 ?></td>
                                                <td><?= $row[2] ?></td>
                                                <td align="center">
                                                    <a href="pages/legal/pendingList/form-updatepenarikan.php?&idInputCaraPen=<?=$row[0]?>"
                                                       data-toggle="modal" data-target="#modalUpdatePenarikan"
                                                       title="Update Penarikan"><i class="fa  fa-unlock"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php

                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-facebook pull-right"
                    onclick="window.location.reload()">Kembali/Cancel
            </button>
        </div>
</div>
<!-- Start Modal Update Penarikan -->
    <div class="modal fade" id="modalUpdatePenarikan" data-keyboard="false" data-backdrop="static"
         role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>
<!-- End -->
<!-- Start Modal Tambah Penarikan -->
    <div class="modal fade" id="modalAddPen" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ccccff">
                    <h4><b>Input Penarikan</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="statusFasilitasMsgTambah"></p>
                            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form-modalAddPen">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" style="text-align: left">Cara Penarikan</label>
                                            <div class="col-sm-9" id="penarikanGroup">
                                                <textarea id="caraPenarikanTambah" rows="6" name="caraPenarikanTambah" class="form-control" placeholder="cara penarikan"></textarea>
                                                <p class="statusCaraPenarikanFasTambah"></p>
                                                <input type="hidden" id="idInputFas" name="idInputFas" value="<?= $idInputFas ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yahoo pull-right submitFasTambahBtn" onclick="sentTambahPenarikan()">
                        Submit
                    </button>
                    <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                        Kembali/Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- End Modal Tambah Penarikan -->

<script>
    $(function () {
        $("#tablePenarikan1").DataTable();
        $('#tablePenarikan2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true
        });
    });

    function sentTambahPenarikan() {
        if($('#caraPenarikanTambah').val().trim() == ''){
            $('.statusCaraPenarikanFasTambah').html('<span style="color:red;">Cara Penarikan Wajib Diisi.</span>');
            return false;
        }else {
            $('.statusCaraPenarikanFasTambah').html('<span style="color:red;"></span>');
        }

        $.ajax({
            type: 'post',
            url: 'pages/legal/pendingList/action-tambahpenarikan.php',
            dataType: 'html',
            data:$('#form-modalAddPen').serialize(),
            success: function (msg) {
                if (msg == 'ok') {
                    $('.statusFasilitasMsgTambah').html('<span style="color:green;">Data Penarikan Telah Tersimpan.</p>');
                    $('.submitFasTambahBtn').attr("disabled", "disabled");
                    $('.modal-body').css('opacity', '.5');
                } else if (msg == 'sql') {
                    $('.statusFasilitasMsgTambah').html('<span style="color:red;">Data Penarikan Gagal Tersimpan.</p>');
                } else {
                    $('.statusFasilitasMsgTambah').html('<span style="color:red;">Data Error.</p>');
                }

            }

        });

    }
</script>
<?php
}else {
    echo "<p>Data Error</p>";
}