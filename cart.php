<?php
session_start();
if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['cart'])){
      $_SESSION['cart'] = array();
        $product_array_ids = array_column($_SESSION['cart'],"product_id");
        if( !in_array($_POST['product_id'],$product_array_ids)){
            $product_array = array(
            'product_id' => $_POST['$product_id'],
            'product_name' => $_POST['$product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' =>  $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
        }else{
            echo '<script> Alert("Product was already to cart");</script>';
            // echo '<script> window.location="index.php";</script>';
        }
    }
    else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity

      );
      $_SESSION['cart'][$product_id] = $product_array;
    }


}else{
  //header('Location:index.php');
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
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Html/Contact.html">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="/Html/cart.html"> <i  class="fas fa-shopping-bag"></i></a>
          <a href="/Html/account.html"><i  class="fa-solid fa-user"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

      <!--Cart-->
        <section class="cart container my-5 py-5">
            <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            </div>
            <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key=>$value){?>
            <tr>
                <td>
                <div class="product-info">
                    <img src="assets/Imgs/<?php echo $value['product_image'];?>" height="80px" width= "80px" margin-right="10px"/>
                    <div>
                    <p><?php echo $value['product_name'];?></p>
                    <small><span>$</span><?php echo $value['product_price'];?></small>
                    <br>
                    <a class="remove-btn" href="#">Remove</a>
                    </div>
                </div>
                </td>
                <td>
                <input type="number" value="<?php echo $value['product_quantity'];?>">
                <a class="edit-btn">Edit</a>
                </td>
                <td>
                <span>$</span><span class="product-price">155</span>
                </td>
            </tr>
            </table>
            <?php }?>

            <div class="cart-total">
                <table>
                    <tr>
                        <td>Sub Total</td>
                        <td>$155</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$155</td>
                    </tr>
                </table>
            </div>

            <div class="checkout-container">
                <button class="checkout-btn"> Checkout</button>
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
