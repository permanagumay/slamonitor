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
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Legal</b>System</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
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
                                        <a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview"><a href="home-pusat.php?page=form-dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i><span>User Management</span>
                            <i class="fa fa-toggle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="home-pusat.php?page=legal-cabang">Legal</a></li>
                            <li><a href="home-pusat.php?page=marketing-cabang">Marketing</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-dashcube"></i><span>Report</span>
                            <i class="fa fa-toggle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
							<li><a href="home-pusat.php?page=form-rekap-jaminan">Rekap Agunan HGB Jatuh Tempo</a></li>
							<li><a href="home-pusat.php?page=form-rekap-asuransi">Rekap Asuransi Jatuh Tempo </a></li>															
                            <li><a href="home-pusat.php?page=form-rekap-covenant">Rekap Document Covenant</a></li>
							<li><a href="home-pusat.php?page=form-rekap-tbo">Rekap Document TBO</a></li>							
                            <li><a href="home-pusat.php?page=form-rekap-deviasi">Rekap Document Deviasi</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">

                <?php
                $page = (isset($_GET['page'])) ? $_GET['page'] : "main";
                switch ($page) {
                    case 'form-dashboard':
                        include "pages/pusat/dashboard/form-dashboard.php";
                        break;
                    case 'form-detailNasabah':
                        include "pages/pusat/nasabah/form-detailnasabah.php";
                        break;
                    case 'legal-cabang':
                        include "pages/pusat/legal/list-legal.php";
                        break;
                    case 'update-legal':
                        include "pages/pusat/legal/update-legal.php";
                        break;
                    case 'marketing-cabang':
                        include "pages/pusat/marketing/list-marketing.php";
                        break;
                    case 'form-rekap-covenant':
                        include "pages/pusat/report/covenant/form-rekap-covenant.php";
                        break;
                    case 'form-rekap-tbo':
                        include "pages/pusat/report/tbo/form-rekap-tbo.php";
                        break;
                    case 'form-rekap-jaminan':
                        include "pages/pusat/report/jaminan/form-rekap-jaminan.php";
                        break;
                    case 'form-rekap-deviasi':
                        include "pages/pusat/report/deviasi/form-rekap-deviasi.php";
                        break;
					case 'form-rekap-asuransi':
                        include "pages/pusat/report/asuransi/form-rekap-asuransi.php";
                        break;
                    case 'form-detailSla':
                        include "pages/pusat/dashboard/form-detail-sla.php";
                        break;
                    default :
                        include "pages/pusat/dashboard/form-dashboard.php";
                }

                ?>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
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