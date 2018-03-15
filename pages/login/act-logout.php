<?php
/*session_start();*/
require_once "../../assets/functions.php";

unset($_SESSION['nik']);
unset($_SESSION['nama']);
unset($_SESSION['hak_akses']);
unset($_SESSION['id_cabang']);

session_destroy();
header("Location:../../index.php");