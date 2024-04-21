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
