<?php
include "../../../assets/koneksi.php";
session_start();
if (isset($_GET['idInputFas'])&& isset($_SESSION['nik'])) {
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
                    <div class="box box-info">
                        <div class="box box-info">
                            <div class="box-body">
                                <table id="tablePenarikan1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Penarikan</th>
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
    <script>
        $(function () {
            $("#tablePenarikan1").DataTable();
            $('#tablePenarikan2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <?php
}else {
    echo "<p>Data Error</p>";
}