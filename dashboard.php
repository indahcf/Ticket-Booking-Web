<?php
  session_start();
  if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }else if($_SESSION['level'] != "Admin"){
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }

  include "koneksi.php";
  $query1 = mysqli_query($koneksi,"select * from jadwal");
  $query2 = mysqli_query($koneksi,"select * from reservasi");
  $hitung_jadwal = mysqli_num_rows($query1);
  $hitung_reservasi = mysqli_num_rows($query2);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SITEKO</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <script src="https://kit.fontawesome.com/9a8c8b96a8.js" crossorigin="anonymous"></script>
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
                </ul>
            </div>

            <div class="main_content">
                <div class="header">
                    Admin
                    <img src="img/profile.jpg" alt=""></a>
                </div>
                <main>
                    <div class="main__container">
                      <!-- MAIN TITLE STARTS HERE -->
            
                      <div class="main__title">
                        <!--<img src="css/hello.svg" alt="" />-->
                        <img src="img/hello.svg" alt="" />
                        <div class="main__greeting">
                          <h1>Hello!</h1>
                          <p>Welcome to your admin dashboard</p>
                        </div>
                      </div>
            
                      <!-- MAIN TITLE ENDS HERE -->
            
                      <!-- MAIN CARDS STARTS HERE -->
                      <div class="main__cards">
                        <div class="card">
                          <i class="fa fa-calendar fa-2x text-lightblue" aria-hidden="true"></i>
                          <div class="card_inner">
                            <p class="text-primary-p">Number of Schedule</p>
                            <span class="font-bold text-title"><?php echo $hitung_jadwal?></span>
                          </div>
                        </div>
            
                        <div class="card">
                          <i class="fa fa-envelope fa-2x text-red" aria-hidden="true"></i>
                          <div class="card_inner">
                            <p class="text-primary-p">Number of Reservations</p>
                            <span class="font-bold text-title"><?php echo $hitung_reservasi?></span>
                          </div>
                        </div>
                      </div>
                      <!-- MAIN CARDS ENDS HERE -->
                  </main>
            </div>
           
            
        </div> 
    </div>
</body>
</html>