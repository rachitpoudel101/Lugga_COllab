<?php
// Start a session
session_start();

// Include the database connection file
include('server/connection.php');

// Check if admin is already logged in
if (isset($_SESSION['admin_logged_in'])) {
    // Redirect to index.php if admin is already logged in
    header('location: index.php');
    // Exit the script to prevent further execution
    exit;
} 
// End of PHP code
?>


<?php
// Check if the login button is pressed
if (isset($_POST['login_btn'])) {
    // Retrieve email and password from the form
    $email = $_POST['email'];
    // Hash the password using md5
    $password = md5($_POST['password']);

    // Prepare a SQL statement to fetch admin details based on email
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admin WHERE admin_email = ?");
    // Bind the email parameter
    $stmt->bind_param('s', $email);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Store the result
        $stmt->store_result();

        // Check if a matching admin record is found
        if ($stmt->num_rows() == 1) {
            // Bind the result variables
            $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
            // Fetch the result
            $stmt->fetch();

            // Check if the entered password matches the stored password
            if ($password == $admin_password) {
                // Set session variables
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;

                // Redirect to index.php with success message
                header('location: index.php?message=logged in successfully');
                // Exit the script
                exit;
            } else {
                // Redirect to login.php with error message for incorrect password
                header('location: login.php?error=incorrect password');
                // Exit the script
                exit;
            }
        } else {
            // Redirect to login.php with error message for user not found
            header('location: login.php?error=user not found');
            // Exit the script
            exit;
        }
    } else {
        // Redirect to login.php with generic error message
        header('location: login.php?error=something went wrong');
        // Exit the script
        exit;
    }
} else {
    // Redirect to login.php if login button is not pressed
    header('location: login.php');
    // Exit the script
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
