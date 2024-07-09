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
    <link rel="stylesheet" type="text/css" href="css/ticket.css">
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
                    <h2>TICKET</h2>
                </div>
                <a href="add_ticket.php" class="button">Add Ticket</a>
                <table class="content-table" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Tiket</th>
                            <th>Seat</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "select * from tiket");
                        while ($ambil_data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $ambil_data['kode_tiket'] ?></td>
                                <td><?php echo $ambil_data['seat'] ?></td>
                                <td><?php echo rupiah($ambil_data['price']); ?></td>
                                <td><?php echo $ambil_data['stock'] ?></td>
                                <td>
                                    <a href="edit_ticket.php?id=<?php echo $ambil_data['kode_tiket'] ?>" class="button">Edit</a>
                                    <a href="hapus_ticket.php?id=<?php echo $ambil_data['kode_tiket'] ?>" class="button" onclick="return confirm ('Yakin dihapus?');">Delete</a>
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