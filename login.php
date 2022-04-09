<?php
session_start();

require("lib/database.php");
if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password_user = $_POST['password'];
  if (empty($username) && empty($password_user)) {
    $msg_type = 'error';
    $msg_content = 'NRP dan Password Tidak Diperbolehkan Kosong.';
  }else{
    $query = mysqli_query($connection,"SELECT * FROM admin where username = $username and password = $password_user");
    if(mysqli_num_rows($query) == 0){
      $msg_type = 'error';
      $msg_content = 'Nrp user tidak terdaftar dan password tidak terdaftar';
    }else{
      $data = mysqli_fetch_assoc($query);
      $_SESSION['admin'] = $data;
      header("location:index.php");
    }
  }
}
include("lib/form_login.php");
if(isset($_SESSION['admin'])) {
  header("location:index.php");
}
?>