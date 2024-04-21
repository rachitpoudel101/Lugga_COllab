<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['admin_logged_in'])) {
    header('location: index.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
   $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admin WHERE admin_email = ?");
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
            $stmt->fetch();

            if ($password == $admin_password) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;
                header('location: index.php?message=logged in successfully');
                exit;
            } else {
                header('location: login.php?error=incorrect password');
                exit;
            }
        } else {
            header('location: login.php?error=user not found');
            exit;
        }
    } else {
        header('location: login.php?error=something went wrong');
        exit;
    }
} else {
    header('location: login.php');
    exit;
}
?>
<?php include( 'header.php'); ?>
<div class="container-fluid">
    <div class="" style="min-height: 1000px">
        <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-item">
                <h1 class="h2">c/h1> <!-- This line should be corrected -->
                <div class="btn-toolbar mb-2 mb-md-g">
                    <div class="btn-group me-2">
                        <!-- Buttons -->
                    </div>
                </div>
            </div>
            <h2>Login</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="login-form" enctype="multipart/form-data" method="POST" action="">
                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>
                        <div class="form-group mt-2">
                            <label>Email</label>
                            <input type="email" class="form-control" id="product-name" name="email">
                        </div>
                        <div class="form-group mt-2">
                            <label>Password</label>
                            <input type="password" class="form-control" id="product-desc" name="password">
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
