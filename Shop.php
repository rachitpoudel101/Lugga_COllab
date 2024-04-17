<?php
session_start();
include("server/connection.php");

if (isset($_SESSION['logged_in'])) {
    header("location: account.php");
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ?");
    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $username, $user_email, $user_password);

        if ($stmt->fetch()) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('location: account.php?message=logged_in_successfully');
        } else {
            header('location: login.php?error=could_not_verify_your_account');
        }
    } else {
        // Error: Something went wrong with the execution of the query
        header('location: login.php?error=something_went_wrong');
    }
}
?>







<!-- Search Section -->
<section id="search" class="my-5 py-5 ms-2">
    <div class="container mt-5 py-5">
        <p>Search Products</p>
    </div>

    <form action="shop.php" method="POST">
        <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Category</p>
                <div class="form-check">
                    <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one" <?php if (isset($category) && $category == 'shoes') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                    <label class="form-check-label" for="category_one">Shoes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="coats" type="radio" name="category" id="category_two" <?php if (isset($category) && $category == 'Coats') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                    <label class="form-check-label" for="category_two">Coats</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="watches" type="radio" name="category" id="category_three" <?php if (isset($category) && $category == 'Watches') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                    <label class="form-check-label" for="category_three">Watches</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="bags" type="radio" name="category" id="category_four" <?php if (isset($category) && $category == 'Bags') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                    <label class="form-check-label" for="category_four">Bags</label>
                </div>
            </div>
        </div>

        <div class="row mx-auto container mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Price</p>
                <div class="w-50">
                    <span style="float: left;">1</span> <span style="float: right;">1000</span>
                </div>
            </div>
        </div>
        <input type="range" class="form-range w-50" name="price" value="<?php echo isset($price) ? $price : ''; ?>" min="0" max="1000">

        <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
        </div>
    </form>
</section>
