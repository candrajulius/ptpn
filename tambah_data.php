<?php
session_start();
$pagetype = "Tambah Karyawan";
require("lib/database.php");
require("lib/config.php");
if(isset($_SESSION['admin'])) {
$session_nrp_ser = $_SESSION['admin']['username'];
$check_admin = mysqli_query($connection,"SELECT * FROM admin where username = '$session_nrp_ser'");
$data_admin = mysqli_fetch_assoc($check_admin);
if(mysqli_num_rows($check_admin) > 0) {
}

include("lib/header.php");
include("lib/form_tambah.php");
include("lib/footer.php");
} else {
  header("location:login.php");
}
?>