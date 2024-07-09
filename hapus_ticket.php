<?php
    include "koneksi.php";
    $kode = $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM tiket WHERE kode_tiket = '$kode';");
    header('location:ticket.php');
?>