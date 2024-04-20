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
                <a class="nav-link" aria-current="page" href="http://localhost/Lugga_COllab/index.php">Home</a>
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
                <i  class="fas fa-shopping-bag"></i>
                <i  class="fa-solid fa-user"></i>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <!-- Checkout -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
          <h2 class="font-weight-bold">Check Out</h2>
          <hr class="mx-auto" />
        </div>
        <div class="mx-auto container">
          <form id="checkout-form checkout-small-element">
            <div class="form-group">
              <label for="checkout-name">Name</label>
              <input
                type="text"
                class="form-control"
                id="checkout-name"
                name="name"
                placeholder="Name"
              />
            </div>
            <div class="form-group checkout-small-element">
              <label for="checkout-email">Email</label>
              <input
                type="text"
                class="form-control"
                id="checkout-email"
                name="email"
                placeholder="Email"
              />
            </div>
            <div class="form-group checkout-small-element">
              <label for="checkout-phone">Phone</label>
              <input
                type="tel"
                class="form-control"
                id="checkout-phone"
                name="phone"
                placeholder="Phone"
              />
            </div>
            <div class="form-group checkout-small-element">
              <label for="checkout-city">City</label>
              <input
                type="text"
                class="form-control"
                id="checkout-city"
                name="city"
                placeholder="City"
              />
            </div>
            <div class="form-group checkout-large-element">
              <label for="checkout-address">Address</label>
              <input
                type="text"
                class="form-control"
                id="checkout-address"
                name="address"
                placeholder="Address"
              />
            </div>
            <div class="form-group checkout-btn-container">
              <input
                type="submit"
                class="btn"
                id="checkout-btn"
                value="Checkout"
              />
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