<?php
include "assets/koneksi.php";
if(isset($_POST['nik']) && isset($_POST['password1'])){
    $nik = $_POST['nik'];
    $oldPass = md5($_POST['password1']);
    $newPass = $_POST['password2'];
    $md5Password = md5($newPass);
    $sql = mysqli_query($Open, "select * from user where nik= '$nik'");

    if($numrow = mysqli_num_rows($sql) > 0){
        $result = mysqli_fetch_array($sql);
        if($result[3] != $oldPass){
            $alert = "<div class='login'>
                        <h1>Password Salah.</h1>                        
                            <a href='index.php'><button type='submit' class='btn btn-primary btn-block btn-large'>Kembali.</button></a>                       
                    </div>    
              ";

        }else {
            $sqlUpdate = mysqli_query($Open, "update user set password = '$md5Password' where nik ='$nik'");
            $alert = "<div class='login'>
                        <h1>Password Berhasil dirubah.</h1>                        
                            <a href='index.php'><button type='submit' class='btn btn-primary btn-block btn-large'>Kembali.</button></a>                       
                    </div>    
              ";

        }

        echo $alert;
    }else {
        $alert = "
                    <div class='login'>
                        <h1>NIK Salah.</h1>                        
                            <a href='index.php'><button type='submit' class='btn btn-primary btn-block btn-large'>Kembali.</button></a>                       
                    </div>
                ";
        echo $alert;
    }

}else {
    echo "Data Error";
}