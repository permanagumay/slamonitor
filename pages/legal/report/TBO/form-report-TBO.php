<div class="box box-body">
    <div class="content">
        <ul class="breadcrumb">
            <li class="active">Report TBO</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <form action="cetak-report-TBO.php" id="form-report-cov" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label" style="text-align: left">Start Date</label>
                            <div class="col-md-4">
                                <div class="input-group input-append date" id="datePickerStartDate">
                                    <input class="form-control" id="startDate" name="startDate" placeholder="yyyy/mm/dd"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <p class="statusEndDate"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" style="text-align: left">End Date</label>
                            <div class="col-md-4">
                                <div class="input-group input-append date" id="datePickerEndDate">
                                    <input class="form-control" id="endDate" name="endDate" placeholder="yyyy/mm/dd"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <p class="statusEndDate"></p>
                                <input type="hidden" name="cabang" value="<?=$_SESSION['id_cabang']?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-yahoo pull-right submitCovenantBtn">
                                Submit
                            </button>
                            <button type="button" class="btn btn-facebook pull-right" onclick="window.location.reload()">
                                Kembali/Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#datePickerEndDate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $('#datePickerStartDate').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
    });

</script>
