<?php
  session_start();
  if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }else if($_SESSION['level'] != "Customer"){
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }

  include "koneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  	<title>SITEKO</title>
	<link rel="stylesheet" href="css/history.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
        <!-- header -->
        <header>
            <img class="logo" src="img/logo.png" alt="logo">
            <nav>
                <ul class="nav_links">
                    <li><a href="home_user.php">Home</a></li>
                    <li><a href="concert_user.php">Concert</a></li>
                </ul>
            </nav>
            <div class="profile">
                <a class="nav-link text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION["email"] ?>
                    <img src="img/profile.jpg" alt="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="history.php"><i class="fas fa-history"></i>History</a></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>
        </header>
        
        <div class="title">
            <h2 align="center">RESERVATION HISTORY</h2>
        </div>
        
        <table class="content-table" style="margin-left:auto;margin-right:auto">
            <thead>
                <tr>
                    <th>Booking Code</th>
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
                    $id_user = $_SESSION['id_user'];
                    $query = mysqli_query($koneksi,"SELECT reservasi.kode_booking,user.name,jadwal.city,jadwal.date,tiket.seat,reservasi.jumlah_tiket,reservasi.total_harga,reservasi.bukti_pembayaran,reservasi.status FROM reservasi LEFT JOIN user ON reservasi.id_user = user.id_user LEFT JOIN jadwal ON reservasi.kode_jadwal = jadwal.kode_jadwal LEFT JOIN tiket ON reservasi.kode_tiket = tiket.kode_tiket WHERE user.id_user = $id_user");
                ?>
                <?php while ($ambil_data=mysqli_fetch_array($query)) : ?>
                    <tr>
                        <td>RTC<?php echo $ambil_data['kode_booking'] ?></td>
                        <td><?php echo $ambil_data['city'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($ambil_data['date'])); ?></td>
                        <td><?php echo $ambil_data['seat'] ?></td>
                        <td><?php echo $ambil_data['jumlah_tiket'] ?></td>
                        <td><?php echo rupiah($ambil_data['total_harga']); ?></td>
                        <td><img class="kotak" id="gambar" src="img/<?= $ambil_data['bukti_pembayaran']==null?'default.jpg':$ambil_data['bukti_pembayaran']; ?>"></td>
                        <td class="status-<?= $ambil_data['status']=='Belum dibayar'?'belum-bayar':($ambil_data['status']=='Pending'?'pending':'lunas'); ?>"><?= $ambil_data['status']; ?></td>
                        <td>
                            <?php if($ambil_data['status']=='Belum dibayar') : ?>
                                <a href="confirm.php?id=<?php echo $ambil_data['kode_booking']?>" class="button">Confirm </a>
                            <?php elseif($ambil_data['status']=='Lunas'): ?>
                                <a href="cetak_ticket.php?id=<?php echo $ambil_data['kode_booking']?>" class="button">Print </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        -->
	</body>
</html>