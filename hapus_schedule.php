<?php
    include "koneksi.php";
    $kode = $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM jadwal WHERE kode_jadwal = '$kode';");
    header('location:schedule.php');
?>