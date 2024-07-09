<?php
    include "koneksi.php";
    $kode_jadwal = $_POST['kode_jadwal'];
    $kota = $_POST['city'];
    $tanggal = $_POST['date'];
    $query = mysqli_query($koneksi,"INSERT INTO `jadwal` (`kode_jadwal`, `city`, `date`) VALUES ('$kode_jadwal', '$kota', '$tanggal');");
    header('location:schedule.php');
?>