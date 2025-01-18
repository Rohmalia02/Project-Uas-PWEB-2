<?php
$servername="localhost";
$username="root";
$password="";
$dbname="db_alumni";

//membuat koneksi
$conn =new mysqli($servername, $username, $password, $dbname);

//memeriksa koneksi
if($conn->connect_error){
    die("koneksi gagal:".$conn->connect_error);
}
?>