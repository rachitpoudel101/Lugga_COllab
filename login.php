<?php
session_start();
include("server/connection.php");

if(isset($_SESSION['logged_in'])){
    header('Location: account.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data based on email
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? LIMIT 1");
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // User found, bind the result
            $stmt->bind_result($user_id, $username, $user_email, $user_password_hashed);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $user_password_hashed)) {
                // Password is correct, set session variables and redirect to account page
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $username;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
                header('Location: account.php?message=logged_in_successfully');
                exit;
            } else {
                // Password is incorrect
                header('Location: login.php?error=incorrect_password');
                exit;
            }
        } else {
            // User not found
            header('Location: login.php?error=user_not_found');
            exit;
        }
    } else {
        // Error occurred during query execution
        header('Location: login.php?error=something_went_wrong');
        exit;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/index.css">
    <script>
        // JavaScript function to display popup message
        function showMessage(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <!--Navbar-->
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
                        <i class="fas fa-shopping-bag"></i>
                        <i class="fa-solid fa-user"></i>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container" method="POST" action="login.php">
            <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {echo htmlspecialchars($_GET['error']);} ?></p>

            <form id="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn "value= "Login">
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </section>






    <!--Footer-->
    <footer class="bg-body-tertiary text-center">
        <div class="container p-4">
            <section class="mb-4">
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
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
