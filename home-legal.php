<?php
ini_set('display_errors', 'Off');
ob_start();
session_start();
require_once "assets/functions.php";
if (!isset($_SESSION['nik'])) {
    die("<b>Oops!</b> Access Denied.
            <p>System Logout. Please Re-login.</p>
            <button type='button' onclick=location.href='index.php'>Back</button>
        ");
}
if(!login_check()){
    header("Location:pages/login/session_exp.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html>
<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Legal Monitoring</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="assets/bootstrap/css/font-awesome.min.css"> <!-- use 4.7.0 -->
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
    <link rel="stylesheet" href="assets/bootstrap/css/ionicons.min.css"><!-- use 2.0.1 -->
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
    <script type="text/javascript" src="assets/plugins/datatables/jquery.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</header>
<body class="hold-transition skin-purple-light">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Legal</b> Monitoring</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <ul class="nav navbar-nav">
                <li><a href="home-legal.php?page=form-dashboard">Dashboard</a></li>
                <li><a href="home-legal.php?page=form-create-debitur">Create Debitur</a></li>
                <li><a href="home-legal.php?page=form-pending">Pending List</a></li>
                <!--<li><a href="#">Report</a></li>-->
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
                    <ul class="dropdown-menu">
						<li><a href="home-legal.php?page=form-report-agunan">Rekap Agunan HGB Jatuh Tempo</a></li>
                        <li><a href="home-legal.php?page=form-report-asuransi">Rekap Asuransi Jatuh Tempo </a></li>
						<li><a href="home-legal.php?page=form-report-TBO">Rekap Doc. TBO</a></li>
                        <li><a href="home-legal.php?page=form-report-cov">Rekap Covenant</a></li>                        
                        <li><a href="home-legal.php?page=form-report-deviasi">Rekap Deviasi</a></li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Control Sidebar Toggle Button -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/dist/img/profile/no-image.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Legal Monitoring</span> &nbsp;<i
                                    class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="assets/dist/img/profile/no-image.jpg" class="img-circle" alt="User Image">
                                <p>Welcome - <?php echo $_SESSION['nama'] ?>
                                </p>
                            </li>
                            <li class="user-body">
                                <div class="row">
                                </div>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php echo date("d-m-Y"); ?>
                                </div>
                                <div class="pull-right">
                                    <a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Log Out.</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main content -->
    <section class="content">
        <?php
        $page = (isset($_GET['page'])) ? $_GET['page'] : "main";
        switch ($page) {
            case 'form-dashboard':
                include "pages/legal/dashboard/dashboard.php";
                break;
            case 'form-create-debitur':
                include "pages/legal/createDebitur/form-create-debitur.php";
                break;
            case 'act-debitur':
                include "pages/legal/createDebitur/act-debitur.php";
                break;
            case 'form-pending':
                include "pages/legal/pendingList/form-pending.php";
                break;
            case 'form-detail':
                include "pages/legal/pendingList/form-detail.php";
                break;
            case 'action-CrmForm':
                include "pages/legal/pendingList/action-CrmForm.php";
                break;
            case 'act-fasilitas':
                include "pages/legal/pendingList/action-fasilitas.php";
                break;
            case 'form-asuransi':
                include "pages/legal/pendingList/form-asuransi.php";
                break;
            case 'form-signin':
                include "pages/legal/sign-in/form-signin.php";
                break;
            case 'form-detail-dashboard':
                include "pages/legal/dashboard/form-detail-dashboard.php";
                break;
            case 'form-report-cov':
                include "pages/legal/report/covenant/form-covenant.php";
                break;
            case 'form-report-TBO':
                include "pages/legal/report/TBO/form-report-TBO.php";
                break;
            case 'form-report-deviasi':
                include "pages/legal/report/deviasi/form-report-deviasi.php";
                break;
            case 'form-report-agunan':
                include "pages/legal/report/agunan/form-report-agunan.php";
                break;
			case 'form-report-asuransi':
                include "pages/legal/report/asuransi/form-report-asuransi.php";
                break;
            case 'act-login':
                include "pages/login/act-login.php";
                break;
            default :
                include "pages/legal/dashboard/dashboard.php";
        }

        ?>


    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
    <footer class="box-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2017 <a href="#">PT. Bank Agris</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="assets/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>


<script>

    $(document).ready(function () {
        var pathname = window.location.pathname;
        $('.nav > li > a[href="' + pathname + '"]').parent().addClass('active');


    })

    function validAngka(a) {
        if (!/^[0-9.]+$/.test(a.value)) {
            a.value = a.value.substring(0, a.value.length - 1000);
        }
    }


</script>

</body>
</html>