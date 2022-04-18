<?php
session_start();
$msg_type ="";
$pagetype = "Export";
require("../lib/database.php");
require("../lib/config.php");
if(isset($_SESSION['admin'])) {
$session_username = $_SESSION['admin']['username'];
$check_admin = mysqli_query($connection,"SELECT * FROM admin where username = '$session_username'");
$data_admin = mysqli_fetch_assoc($check_admin);
if(mysqli_num_rows($check_admin) > 0) {
}

if(isset($_GET['id'])) {
  $karyawan_id = $_GET['id'];
  $delete = mysqli_query($connection,"DELETE FROM `karyawan` WHERE `karyawan`.`id` = $karyawan_id;");
  if($delete == true){
      $msg_type = "success";
      $msg_content = "Data berhasil dihapus";
  }else{
      $msg_type = "error";
      $msg_content = "Systemn Error";
  }
}

include("../lib/header.php");
include("table.php");
include("../lib/footer.php");
} else {
  header("location:login.php");
}
?>