<?php
    session_start();

    require 'koneksi.php';

    if(isset($_POST['login'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      $result = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
      $data = mysqli_fetch_array($result);
      if ($email == $data['email'] && $password == $data['password'])
      {
          if ($data['level']=='Admin')
          {
              $_SESSION['id_user'] = $data['id_user'];
              $_SESSION['email'] = $data['email'];
              $_SESSION['level'] = $data['level'];
              header("location:dashboard.php");
          }
          else
          if ($data['level']=='Customer')
          {	
              $_SESSION['id_user']=$data['id_user'];
              $_SESSION['email']=$data['email'];
              $_SESSION['level']=$data['level'];
              header("location:home_user.php");
          }
      }
      else{
          echo "
          <script>
          alert('Username atau password salah!');
          </script>
          ";
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>SITEKO</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="img/bg.jpg">
		</div>
		<div class="login-content">
			<form action="" method="POST">
				<img src="img/logo.png">
				<h2 class="title">Login</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" name="email" class="input" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input" required>
            	   </div>
            	</div>
            	<input type="submit" name="login" class="btn" value="Login">
                <a href="register.php">Don't have an account? Register here</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>