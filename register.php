<?php
  require 'koneksi.php';

  if(isset($_POST["register"])){

    if(registrasi($_POST) > 0){
      echo "<script>
            alert('User baru berhasil ditambahkan!');
            document.location.href = 'login.php';
            </script>";
    }
    else{
      echo mysqli_error($koneksi);
    }
  }
?>

<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <title>SITEKO</title>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="css/register.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Create Your Account</div>
    <div class="content">
      <form action="" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="no_hp" id="no_hp" placeholder="Enter your phone number" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" id="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirm_password" id="confirm_passord" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="register" value="Register">
        </div>
      </form>
    </div>
  </div>
</body>
</html>
