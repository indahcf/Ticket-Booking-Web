<?php
    session_start();
    if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
        echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
    }else if($_SESSION['level'] != "Admin"){
        echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
    }

    include "koneksi.php";

    if(isset($_POST['submit'])){
        $kodeBooking = $_POST['kode_booking'];
        $query = "UPDATE reservasi SET status = 'Lunas' WHERE kode_booking = '$kodeBooking'";
        mysqli_query($koneksi,$query);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SITEKO</title>
        <link rel="stylesheet" type="text/css" href="css/reservasi_admin.css">
        <script src="https://kit.fontawesome.com/9a8c8b96a8.js" crossorigin="anonymous"></script>

        <style>
            .status-belum-bayar{
                color:red;
            }

            .status-pending{
                color:orange;
            }

            .status-lunas{
                color:green;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar">
                <img class="logo" src="img/logo.png" alt="logo">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a></li>
                    <li><a href="customer.php"><i class="fas fa-users"></i>Customer</a></li>
                    <li><a href="schedule.php"><i class="fas fa-calendar-alt"></i>Schedule</a></li>
                    <li><a href="ticket.php"><i class="fas fa-ticket-alt"></i>Tickets</a></li>
                    <li><a href="reservasi_admin.php"><i class="fas fa-envelope"></i>Reservations</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            </div>
        
            <div class="main_content">
                <div class="header">
                    Admin
                    <img src="img/profile.jpg" alt=""></a>
                </div>
                <div class="content">
                    <div class="title">
                        <h2 align="center">RESERVATION</h2>
                    </div>
                    <div class="search-box">
                        <form action="" method="GET">
                            <input class="input-box" type="text" name="keyword" placeholder="Search...">
                            <a class="btn" href="#" type="submit" name="cari"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                    <table class="content-table" style="margin-left:auto;margin-right:auto">
                        <thead>
                            <tr>
                                <th>Booking Code</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Seating Option</th>
                                <th>Number of Tickets</th>
                                <th>Total Payment</th>
                                <th>Payment Slip</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['keyword'])){
                                    $keyword = $_GET['keyword'];
                                    $query = mysqli_query($koneksi,"SELECT reservasi.kode_booking,user.name,jadwal.city,jadwal.date,tiket.seat,reservasi.jumlah_tiket,reservasi.total_harga,reservasi.bukti_pembayaran,reservasi.status FROM reservasi LEFT JOIN user ON reservasi.id_user = user.id_user LEFT JOIN jadwal ON reservasi.kode_jadwal = jadwal.kode_jadwal LEFT JOIN tiket ON reservasi.kode_tiket = tiket.kode_tiket where user.name like '%$keyword%' or jadwal.city like '%$keyword%'");
                                }
                                else{
                                $query = mysqli_query($koneksi,"SELECT reservasi.kode_booking,user.name,jadwal.city,jadwal.date,tiket.seat,reservasi.jumlah_tiket,reservasi.total_harga,reservasi.bukti_pembayaran,reservasi.status FROM reservasi LEFT JOIN user ON reservasi.id_user = user.id_user LEFT JOIN jadwal ON reservasi.kode_jadwal = jadwal.kode_jadwal LEFT JOIN tiket ON reservasi.kode_tiket = tiket.kode_tiket");
                                }
                                while ($ambil_data=mysqli_fetch_array($query)){ 
                            ?> 
                                <tr>
                                    <td>RTC<?php echo $ambil_data['kode_booking'] ?></td>
                                    <td><?php echo $ambil_data['name'] ?></td>
                                    <td><?php echo $ambil_data['city'] ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($ambil_data['date'])); ?></td>
                                    <td><?php echo $ambil_data['seat'] ?></td>
                                    <td><?php echo $ambil_data['jumlah_tiket'] ?></td>
                                    <td><?php echo rupiah($ambil_data['total_harga']); ?></td>
                                    <td><img class="kotak" id="gambar" src="img/<?= $ambil_data['bukti_pembayaran']==null?'default.jpg':$ambil_data['bukti_pembayaran']; ?>"></td>
                                    <td class="status-<?= $ambil_data['status']=='Belum dibayar'?'belum-bayar':($ambil_data['status']=='Pending'?'pending':'lunas'); ?>"><?= $ambil_data['status']; ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="kode_booking" value="<?php echo $ambil_data['kode_booking'] ?>">
                                            <?php if($ambil_data['status']=='Pending'): ?>
                                                <button class="button" type="submit" name="submit">Confirm</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
    </body>
</html>