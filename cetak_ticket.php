<?php
    session_start();
    if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
        echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
    }else if($_SESSION['level'] != "Customer"){
        echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
    }

    include "koneksi.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SITEKO</title>
        <link rel="stylesheet" type="text/css" href="css/cetak_ticket.css">
        <script src="https://kit.fontawesome.com/9a8c8b96a8.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <img class="logo" src="img/logo.png" style="float:left">

        <div style="margin-left: 20px">
            <div style="font-size: 18px">Concert Ticket Day6</div>
            <div style="font-size: 20px">DAY6 WORLD TOUR : GRAVITY</div>
        </div>

        <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">


        <h3 class="judul">RESERVATION TICKET</h3>
        <table>
            <?php
                $kodeBooking = $_GET['id'];
                $query = mysqli_query($koneksi,"SELECT reservasi.kode_booking,user.name,jadwal.city,jadwal.date,tiket.seat FROM reservasi LEFT JOIN user ON reservasi.id_user = user.id_user LEFT JOIN jadwal ON reservasi.kode_jadwal = jadwal.kode_jadwal LEFT JOIN tiket ON reservasi.kode_tiket = tiket.kode_tiket where kode_booking = '$kodeBooking'");
                $ambil_data=mysqli_fetch_array($query);
            ?>
                <tr>
                    <td>Booking Code</td>
                    <td>:</td>
                    <td><b>RTC<?= $ambil_data['kode_booking'] ?></b></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?= $ambil_data['name'] ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?= $ambil_data['city'] ?></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>:</td>
                    <td><?= date('d/m/Y', strtotime($ambil_data['date'])); ?></td>
                </tr>
                <tr>
                    <td>Seat</td>
                    <td>:</td>
                    <td><?= $ambil_data['seat'] ?></td>
                </tr>
        </table>

        <script type="text/javascript">
        window.onload = function() { window.print(); }
        </script>
    </body>
</html>