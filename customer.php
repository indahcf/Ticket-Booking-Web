<?php
session_start();
if (empty($_SESSION['email']) or empty($_SESSION['level'])) {
    echo "<script>alert('Maaf Anda harus login terlebih dahulu, terima kasih');document.location='login.php'</script>";
} else if ($_SESSION['level'] != "Admin") {
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
    <link rel="stylesheet" type="text/css" href="css/customer.css">
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
                    <h2>CUSTOMER</h2>
                </div>
                <div class="search-box">
                    <form action="" method="GET">
                        <input class="input-box" type="text" name="keyword" placeholder="Search...">
                        <a class="btn" href="#" type="submit" name="cari"><i class="fas fa-search"></i></a>
                    </form>
                </div>
                <table class="content-table" width="100%">
                    <thead>
                        <tr>
                            <th>ID Customer</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['keyword'])) {
                            $keyword = $_GET['keyword'];
                            $query = mysqli_query($koneksi, "select * from user where name like '%$keyword%'");
                        } else {
                            $query = mysqli_query($koneksi, "select * from user where level = 'Customer'");
                        }
                        while ($ambil_data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $ambil_data['id_user'] ?></td>
                                <td><?php echo $ambil_data['name'] ?></td>
                                <td><?php echo $ambil_data['no_hp'] ?></td>
                                <td><?php echo $ambil_data['email'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>