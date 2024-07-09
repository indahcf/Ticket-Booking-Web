<?php
  session_start();
  if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }else if($_SESSION['level'] != "Admin"){
      echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
  }

  include "koneksi.php";
  $kode = $_GET['id'];
    if(isset($_POST['edit'])){
        $kode_jadwal = $_POST['kode_jadwal'];
        $kota = $_POST['city'];
        $tanggal = $_POST['date'];
        $query = mysqli_query($koneksi,"update jadwal set city = '$kota',date = '$tanggal' where kode_jadwal = '$kode'");
        if($query){
          echo "<script>alert('Data berhasil diubah!')</script>";
          echo "<meta http-equiv=refresh content=1;url=schedule.php>";
        }
        else{
            echo "Data gagal diubah!";
        }
    }
    $query = mysqli_query($koneksi,"select * from jadwal where kode_jadwal = '$kode'");
    $ambil_data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SITEKO</title>
        <link rel="stylesheet" type="text/css" href="css/edit_schedule.css">
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
                <div class="content">
                    <div class="title">
                        <h2 align="center">EDIT SCHEDULE</h2>
                    </div>
                    <div class="schedule">
                        <form action="" method="POST">
                            <table>
                                <tr>
                                    <td><label>Kode Jadwal</label></td>
                                    <td><input name="kode_jadwal" type="text" value = "<?php echo $ambil_data['kode_jadwal'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td><label>City</label></td>
                                    <td><input name="city" type="text" value = "<?php echo $ambil_data['city'] ?>"></td>
                                </tr>
                                <tr>
                                    <td><label>Date</label></td>
                                    <td><input name="date" type="date" value = "<?php echo $ambil_data['date'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="button" type="submit" value="Save" name='edit'>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>        