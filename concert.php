<?php
  include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SITEKO</title>
	<link rel="stylesheet" type="text/css" href="css/concert.css">
</head>
<body>
	<!-- header -->
	<header>
        <img class="logo" src="img/logo.png" alt="logo">
		<nav>
            <ul class="nav_links">
                <li><a href="home.html">Home</a></li>
                <li><a href="concert.php">Concert</a></li>
            </ul>
        </nav>
        <a class="cta" href="login.php"><button>Login</button></a>
	</header>
	
	<main class="main">
		<div class="container">
			<!--Gambar day6nya-->
			<!-- <img class="day6" src="img/day6.png"> -->
            <h3>DAY6 WORLD TOUR:</h3>
            <h2>GRAVITY</h2>
		</div>
	</main>

	<table class="content-table" style="margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th>City</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = mysqli_query($koneksi,"select * from jadwal");
                while ($ambil_data=mysqli_fetch_array($query)){ 
            ?>
                <tr>
                    <td><?php echo $ambil_data['city'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($ambil_data['date'])); ?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>