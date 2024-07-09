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
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
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
                    <h2>CONCERT SCHEDULE</h2>
                </div>
                <a href="add_schedule.php" class="button">Add Schedule</a>
                <table class="content-table" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "select * from jadwal");
                        while ($ambil_data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $ambil_data['kode_jadwal'] ?></td>
                                <td><?php echo $ambil_data['city'] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($ambil_data['date'])); ?></td>
                                <td>
                                    <a href="edit_schedule.php?id=<?php echo $ambil_data['kode_jadwal'] ?>" class="button">Edit</a>
                                    <a href="hapus_schedule.php?id=<?php echo $ambil_data['kode_jadwal'] ?>" class="button">Delete</a>
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
</body>

</html>