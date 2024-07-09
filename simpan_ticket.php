<?php
    include "koneksi.php";
    $kode_tiket = $_POST['kode_tiket'];
    $seat = $_POST['seat'];
    $harga = $_POST['price'];
    $stock = $_POST['stock'];
    $query = mysqli_query($koneksi,"INSERT INTO `tiket` (`kode_tiket`, `seat`, `price`, `stock`) VALUES ('$kode_tiket', '$seat', '$harga', '$stock');");
    header('location:ticket.php');
?>