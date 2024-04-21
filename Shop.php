<?php
include('server/connection.php');

// Use the search section
if (isset($_POST['search'])) {
    // 1. Determine page no
    if (isset($_GET['page_no']) && $_GET['page_no'] != '') {
        // If user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];
    $price = $_POST['price'];

    // 2. Return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // 3. Products per page
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = 2;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // 4. Get all products
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset, $total_records_per_page");
    $stmt2->bind_param('si', $category, $price);
    $stmt2->execute();
    $products = $stmt2->get_result();
} else {
    // Determine page number
    if (isset($_GET['page_no']) && $_GET['page_no'] != '') {
        // If user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then default page is 1
        $page_no = 1;
    }

    // Return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // Products per page
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = 2;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // Get all products
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt2->bind_param('ii', $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
}
?>

<?php include('layouts/header.php'); ?>



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
