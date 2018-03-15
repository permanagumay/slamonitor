<div class="login-box">
    <?php
    include "assets/koneksi.php";
    require_once "assets/functions.php";
    $nik = $_POST['nik'];
    $password = $_POST['password'];
    $passMd5 = md5($password);
    $op = $_GET['op'];
    if ($op == 'in') {
        $sql = mysqli_query($Open, "select * from user where nik = '$nik' and password = '$passMd5'");
        if (mysqli_num_rows($sql) > 0) {
            $result = mysqli_fetch_array($sql);
            session_start();
            $_SESSION['nik'] = $result['nik'];
            $_SESSION['nama'] = $result['nama'];
            $_SESSION['hak_akses'] = $result['hak_akses'];
            $_SESSION['id_cabang'] = $result['id_cabang'];

            if ($result['aktif'] == 'N') {
                echo "
                       <div class='login'>
                            <div class='register-logo'><h2 style='color: #ffffff'><b style='color: #4d9200'>Oops!</b> Login Failed.</h2></div>
                            <div class='register-box-body'>
                            <p style='color: #4d9200'>Please Contact your admin.</p>
                            <div class='row'>
                                <div class='col-xs-8'></div>
                                <div class='col-xs-4'>
                                    <button type='button' onclick=location.href='index.php' class='btn btn-primary btn-block btn-large'>Back.</button>
                                </div>
                            </div>
                        </div>
                       </div>
                    ";
            } else {
                if ($result['hak_akses'] == 1) {

                } else if ($result['hak_akses'] == 2) {
                    login_validate();
                    logLogin($_SESSION['nik']);
                    header("location:home-pusat.php");
                } else if ($result['hak_akses'] == 3) {
                    login_validate();
                    logLogin($_SESSION['nik']);
                    header("location:home-legal.php");
                }
            }
        } else {
            echo "
                    <div class='login'>
                        <div class='register-logo'><h2 style='color: #ffffff'><b style='color: #4d9200'>Oops!</b> Login Failed.</h2></div>
                        <div class='register-box-body'>
                            <p style='color: #4d9200'>Nik or Password is Wrong.</p>
                            <div class='row'>
                                <div class='col-xs-8'></div>
                                <div class='col-xs-4'>
                                    <button type='button' onclick=location.href='index.php' class='btn btn-primary btn-block btn-large'>Back.</button>
                                </div>
                            </div>
                        </div>
                    </div>                    
                ";

        }
    } else if ($op == "out") {

        require_once "../../assets/functions.php";
        logLogOut($_SESSION['nik']);
        unset($_SESSION['nik']);
        unset($_SESSION['nama']);
        unset($_SESSION['hak_akses']);
        unset($_SESSION['id_cabang']);

        session_destroy();
        header("Location:../index.php");
    }

    ?>
</div>