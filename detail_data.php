<?php
session_start();
$msg_type = "";
$pagetype = "Detail Karyawan";
require("lib/database.php");
require("lib/config.php");
if(isset($_SESSION['admin'])) {
$session_username = $_SESSION['admin']['username'];
$check_admin = mysqli_query($connection,"SELECT * FROM admin where username = '$session_username'");
$data_admin = mysqli_fetch_assoc($check_admin);
if(mysqli_num_rows($check_admin) > 0) {
}

if(isset($_GET['nrp'])) {
    $target_data = $_GET['nrp'];
    $query = mysqli_query($connection,"SELECT * FROM karyawan WHERE nrp = '$target_data'");
    $data = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) == 0) {
        header("location: $page_not_found");
    }
include("lib/header.php");
include("lib/detail_karyawan.php");
include("lib/footer.php");
} else {
    header("location: $page_not_found");
}
} else {
  header("location:login.php");
}
?>