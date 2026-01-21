<?php
$conn = mysqli_connect("localhost","root","","kosmetik");
if(!$conn){
    die("Koneksi gagal");
}
session_start();
?>
