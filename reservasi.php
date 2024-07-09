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
	<link rel="stylesheet" type="text/css" href="css/reservasi.css">
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
            <h2 align="center">DAY6 WORLD TOUR: GRAVITY</h2>
            <h3 align="center">RESERVATION</h3>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <form action="" method="POST">
                    <div class="reservation">
                        <div class="row input-box">
                            <label class="col-5">City</label>
                            <select class="col-7" name="kode_jadwal" id="city">
                                <option value="">Choose City</option>
                                <?php
                                    $sql_city = mysqli_query($koneksi,"select * from jadwal") or die (mysqli_error($koneksi));
                                    while($jadwal = mysqli_fetch_array($sql_city)){
                                    echo '<option value='.$jadwal['kode_jadwal'].'>'.$jadwal['city'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="row input-box">
                            <label class="col-5">Date</label>
                            <input class="col-7" name="date" id="date" type="text" readonly>
                        </div>
                        <div class="row input-box">
                            <label class="col-5">Seating Option</label>
                            <select class="col-7" name="kode_tiket">
                                <option value="">Choose Seating</option>
                                <?php
                                    $sql_seat = mysqli_query($koneksi,"select * from tiket") or die (mysqli_error($koneksi));
                                    while($tiket = mysqli_fetch_array($sql_seat)){
                                    echo '<option value='.$tiket['kode_tiket'].'>'.$tiket['seat'].' - '.rupiah($tiket['price']).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="row input-box">
                            <label class="col-5">Number of Tickets</label>
                            <input class="col-7" name="jumlah_tiket" type="text" placeholder="Enter your number of tickets" required>
                        </div>
                        <div class="row">
                            <div class="col-5"></div>
                            <input class="col-7 button" type="submit" name="submit" value="Next">
                        </div>
                    </div>
                </form>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
                <script>
                    $(function() {
                        $("#city").change(function(){
                            var city = $("#city").val();
            
                            $.ajax({
                                url: 'proses.php',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'city': city
                                },
                                success: function (jadwal) {
                                    $("#date").val(jadwal['date']);
                                }
                            });
                        });
            
                        /*$("form").submit(function(){
                            alert("Keep learning");
                        });*/
                    });
                </script>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <img class="img-fluid" src="img/seating plan.PNG" alt="">
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

<?php
    if(isset($_POST['submit'])){
        $id_user = $_SESSION['id_user'];
        $kode_jadwal = $_POST['kode_jadwal'];
        $kode_tiket = $_POST['kode_tiket'];
        $jumlah_tiket= $_POST['jumlah_tiket'];
        $tiket = mysqli_query($koneksi, "SELECT * FROM tiket WHERE kode_tiket ='$kode_tiket'");
        $ambil_data = mysqli_fetch_array($tiket);
        $total_harga = $_POST['jumlah_tiket']* $ambil_data['price'];
        $query = mysqli_query($koneksi,"INSERT INTO `reservasi` (`kode_booking`, `id_user`, `kode_jadwal`, `kode_tiket`, `jumlah_tiket`, `total_harga`, `bukti_pembayaran`, `status`) VALUES (NULL, '$id_user', '$kode_jadwal', '$kode_tiket', '$jumlah_tiket', '$total_harga', NULL, 'Belum dibayar');");
        
        if($query){
            echo "
            <script>
            alert('Berhasil memasukkan data');
            window.location='pembayaran.php';
            </script>
            ";
        }
        else{
            echo "
            <script>
            alert('Gagal memasukkan data');
            </script>
            ";
        }
    }
?>

