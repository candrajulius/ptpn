<?php
 $host = "localhost";
 $user = "root";
 $password = "";
 $dbname = "tugas_mei";
 $connection = mysqli_connect($host,$user,$password,$dbname);

 if(!$connection){
     die("error in connection");
 }
?>