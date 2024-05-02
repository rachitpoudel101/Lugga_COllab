<?php
session_start();
include("server/connection.php");

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if($password !== $confirmPassword){
    header('Location: register.php?error=passwords dont match');
    exit();
  } else if(strlen($password) < 6){
    header('Location: register.php?error=Password must be at least 6 characters');
    exit();
  } else {
      $stmt = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
      $stmt->bind_param('s', $email); // Bind email parameter
      $stmt->execute();
      $stmt->bind_result($num_rows);
      $stmt->fetch();
      $stmt->close();

      if($num_rows > 0){
        header('Location: register.php?error=email already exists');
        exit();
      } else {
        $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES(?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $password); // Bind all parameters
        if($stmt->execute()){
          $_SESSION['user_email'] = $email;
          $_SESSION['user_name'] = $name; 
          $_SESSION['logged_in'] = true;
          header('Location: account.php?register=You registered Successfully');
          exit();
        } else {
          header('Location: register.php?error=Could not create an account currently');
          exit();
        }
    }
  }}
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
                <a class="nav-link" aria-current="page" href="/Html/index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Html/Shop.html">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-disabled="true">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-disabled="true">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-shopping-bag"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <!-- Register Section -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" action="register.php" method="POST">
              <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register">
                </div>
                <div class="form-group">
                    <a id="login-url" class="btn" href="#">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </section>

    <!--Footer-->
    <footer class="bg-body-tertiary text-center">
        <div class="container p-4">
          <section class="mb-4">
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-twitter"></i
            ></a>
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-google"></i
            ></a>
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-instagram"></i
            ></a>
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"
              ><i class="fab fa-github"></i
            ></a>
          </section>
          <section class="">
            <form action="">
              <div class="row d-flex justify-content-center">
                <div class="col-auto">
                  <p class="pt-2">
                    <strong>Sign up for our Website</strong>
                  </p>
                </div>
                <div class="col-md-5 col-12">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="form5Example24" class="form-control" />
                    <label class="form-label" for="form5Example24">Email address</label>
                  </div>
                </div>
                <div class="col-auto">
                  <button data-mdb-ripple-init type="submit" class="btn btn-outline mb-4">
                    Subscribe
                  </button>
                </div>
              </div>
            </form>
          </section>
     
          <section class="mb-4">
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
              repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam eum
              harum corrupti dicta, aliquam sequi voluptate quas.
            </p>
          </section>
          <section class="">
            <div class="row">
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contact Us </h5>
    
                <ul class="list-unstyled mb-0">
                  <li>
                    <a class="text-body" href="#!">Shop</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">account</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">About Us</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">Contact Us</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Cataogery</h5>
    
                <ul class="list-unstyled mb-0">
                  <li>
                    <a class="text-body" href="#!">Men</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">Woman</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">kids</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!"></a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Seasonal</h5>
    
                <ul class="list-unstyled mb-0">
                  <li>
                    <a class="text-body" href="#!">Winter</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">Spring</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">Autum</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">sUMMER</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">account</h5>
    
                <ul class="list-unstyled mb-0">
                  <li>
                    <a class="text-body" href="#!">My account</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">Cart</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">paymethod</a>
                  </li>
                  <li>
                    <a class="text-body" href="#!">My dashboard</a>
                  </li>
                </ul>
              </div>
            </div>
          </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
          © 2020 Copyright:
          <a class="text-reset fw-bold" href="">Lugga</a>
        </div>
      </footer>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
    </html>