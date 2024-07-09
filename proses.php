<?php
    include 'koneksi.php';
    
    $query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_jadwal='".mysqli_escape_string($koneksi, $_POST['city'])."'");
    $data = mysqli_fetch_array($query);
    
    echo json_encode($data);
?>