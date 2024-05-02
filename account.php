<?php
session_start();
include('server/connection.php');
if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $user_email = $_POST['user_email'];

  if($password !== $confirmPassword){
    header('Location: account.php?error=passwords dont match');
    exit();
  } else if(strlen($password) < 6){
    header('Location: account.php?error=Password must be at least 6 characters');
    exit();
  }
  else{
    // Hash the password using password_hash() function
    $hashed_password = ($password);
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', $hashed_password, $user_email);
    if($stmt->execute()){
      header('location:account.php?message=password has been updated successfully');
    }else{
      header('location:account.php?error=could not update password');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed top">
    <div class="container">
      <img src="/assets/Imgs/logo.png" alt="Logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Shop.html">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contact.html">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="cart.html"><i class="fas fa-shopping-bag"></i></a> 
            <a href="account.html"> <i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Account -->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
            <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
            <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name<span> <?php if (isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];} ?></span></p>
                <p>Email<span> <?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="order-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
    <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
        <h3>Change Password</h3>
        <hr class="mx-auto">
        <div class="form-group">
            <label for="account-password">Password</label>
            <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="account-password-confirm">Confirm Password</label>
            <input type="password" class="form-control" id="account-password-confirm" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
        </div>
    </form>
</div>

    </div>
</section>

<!--orders-->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Date</th>
        </tr>
        <!-- You can loop through orders here -->
        <tr>
            <td>Order Code</td>
            <td>Date</td>
        </tr>
        <!-- Repeat the above <tr> for each order -->
    </table>
</section>

<!--Footer-->
<footer class="bg-body-tertiary text-center">
    <!-- Footer content -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>