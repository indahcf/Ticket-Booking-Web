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
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>SITEKO</title>
	<link rel="stylesheet" type="text/css" href="css/pembayaran.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

    <div class="container">
        <div class="title">
            <h2 align="center">PAYMENT</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $ID = $_SESSION['id_user'];
                    $query = mysqli_query($koneksi,"select * from reservasi where id_user = '$ID' order by kode_booking DESC");
                    $ambil_data=mysqli_fetch_array($query);
                ?>
                    <div class="kotak">
                        <p>Booking Code: <br> <b>RTC<?php echo $ambil_data['kode_booking'] ?></b></p>
                        <p>Total Payment: <br> <b><?php echo rupiah($ambil_data['total_harga']); ?></b></p>
                        <a class="cta" href="confirm.php?id=<?php echo $ambil_data['kode_booking']?>"><button>Confirm</button></a>
                    </div>
            </div>
            <div class="col-md-6">
                <h4 align="left">PAYMENT METHOD</h4>
                <ol>
                    <li>Pembayaran dilakukan dengan cara transfer ke no rekening</li>
                    <li>Catat kode pembayaran yang Anda dapatkan</li>
                    <li>Bayar sesuai nominal</li>
                    <li>Simpan bukti pembayaran</li>
                    <li>Upload bukti pembayaran</li>
                </ol>
                <img class="bank" src="img/bank_remove.png" alt="">
            </div>
        </div>
    </div>

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