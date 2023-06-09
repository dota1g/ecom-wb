<!DOCTYPE html>
<html lang="en">

<head>
  <title>WB | All Items</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>
<?php
session_start();
include("config.php");
if (isset($_SESSION['login_user'])) {
  $user = $_SESSION['login_user'];
  $usersql = "SELECT * from users where username ='$user' or email = '$user' limit 1";
  $userResult = mysqli_query($db, $usersql);
  $userRow = mysqli_fetch_assoc($userResult);

  $getUnreadMails = "SELECT * from email where userID=" . $userRow['userID'] . " AND didUserReadMsg = 0 and isFromAdmin = 1";
  $resultxdd = mysqli_query($db, $getUnreadMails);
  $unreadMailsCount = mysqli_num_rows($resultxdd);
}

$productsql = "SELECT * from products";
$productresult = mysqli_query($db, $productsql);
?>

<body>
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 invisible order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <img src="images/header.png" style="
                width: 50%;
                height: auto;
                  ">
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
              <ul>
              <?php
                  if (empty($_SESSION['login_user'])) {
                    echo "<li><a href=\"login.php\" class=\"btn btn-secondary\">Log in</a></li>";
                  } else {
                    echo "<li>Hello, " . $userRow['firstName'] . " <a href=\"logout.php\">(Logout)</a></li>
                    <li>
                      <a href=\"inbox.php\" class=\"site-cart\">
                        <span class=\"icon icon-envelope-o\"></span>
                        ".($unreadMailsCount > 0 ? "<span class=\"count\">".$unreadMailsCount."</span>" : "")."
                      </a>
                    </li>
                    <li>
                    <a href=\"cart.php\" class=\"site-cart\">
                      <span class=\"icon icon-shopping_cart\"></span>
                    </a>
                  </li>
                  <li>
                </li>
                    ";
                  }
                  ?>
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu  d-none d-md-block">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="about.php">About</a>
            </li>
            <li class="active"><a href="shop.php">Shop</a></li>
            <li><a href="composemsg.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="float-md-left mb-2">
                  <h2 class="text-black h5">Shop All</h2>
                </div>

              </div>
            </div>
            <div class="row mb-5">

              <?php
              while ($row = mysqli_fetch_assoc($productresult)) {
                echo "<div class=\"col-sm-6 col-lg-4 mb-4 border\" data-aos=\"fade-up\">
                    <div class=<\"block-4 text-center\">
                    <figure class=\"block-4-image\">
                        <a href=\"shop-single.php?id=" . $row['productID'] . "\"><img src='../images/" . $row['productImg'] . "' class=\"img-fluid\"></a>
                    </figure>
                    <div class=\"block-4-text p-4\">
                        <h5 class=\"text-center\"><a href=\"shop-single.php?id=" . $row['productID'] . "\">" . $row['productName'] . "</a></h5>
                        <p class=\"mb-0 block-4 text-center\">" . $row['productShortDesc'] . "</p>
                        <p class=\"text-primary text-center font-weight-bold\">>₱" . $row['productPrice'] . "</p>
                        ".($row['isProductAvailable'] == 1 ? "" : "<p class=\"alert-danger text-center\">Not available</p>")."
                    </div>
                </div>
                </div>";
              }
              //teyvat archons please help
              ?>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Ad space</h3>
              <ul class="list-unstyled mb-0">
                <li class="mb-1 invisible"><a href="#" class="d-flex"><span>Graphic Design</span> <span class="text-black ml-auto">(2,220)</span></a></li>
                <li class="mb-1 invisible"><a href="#" class="d-flex"><span>Illustrations</span> <span class="text-black ml-auto">(2,550)</span></a></li>
                <li class="mb-1 invisible"><a href="#" class="d-flex"><span>UI/UX Design</span> <span class="text-black ml-auto">(2,124)</span></a></li>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Ad space but significantly bigger</h3>
                <div id="slider-range invisible" class="border-primary "></div>
                <input type="text" name="text" id="amount" class="form-control invisible border-0 pl-0 bg-white" disabled="" />
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block invisible">Type</h3>
                <label for="s_sm" class="d-flex">
                  <input type="checkbox" id="s_sm" class="mr-2 mt-1 invisible"> <span class="text-black invisible">Personal</span>
                </label>
                <label for="s_md" class="d-flex">
                  <input type="checkbox" id="s_md" class="mr-2 mt-1 invisible"> <span class="text-black invisible">Commercial</span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <footer class="site-footer border-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="row">
                  <div class="col-md-12">
                    <h3 class="footer-heading mb-4">Navigations</h3>
                  </div>
                  <div class="col-md-6 col-lg-4">
                    <ul class="list-unstyled">
                      <li><a href="#">Sell online</a></li>
                      <li><a href="#">Features</a></li>
                      <li><a href="#">Shopping cart</a></li>
                      <li><a href="#">Store builder</a></li>
                    </ul>
                  </div>
                  <div class="col-md-6 col-lg-4">
                    <ul class="list-unstyled">
                      <li><a href="#">Mobile commerce</a></li>
                      <li><a href="#">Dropshipping</a></li>
                      <li><a href="#">Website development</a></li>
                    </ul>
                  </div>
                  <div class="col-md-6 col-lg-4">
                    <ul class="list-unstyled">
                      <li><a href="#">Point of sale</a></li>
                      <li><a href="#">Hardware</a></li>
                      <li><a href="#">Software</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <h3 class="footer-heading mb-4">Promo</h3>
                <a href="#" class="block-6">
                  <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
                  <h3 class="font-weight-light  mb-0">Finding Your Perfect Vibe</h3>
                </a>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                  <h3 class="footer-heading mb-4">Contact Info</h3>
                  <ul class="list-unstyled">
                    <li class="email">alfredtheslugger@gmail.com</li>
                  </ul>
                </div>

                <div class="block-7">
                  <form action="#" method="post">
                    <label for="email_subscribe" class="footer-heading">Subscribe</label>
                    <div class="form-group">
                      <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                      <input type="submit" class="btn btn-sm btn-primary" value="Send">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row pt-5 mt-5 text-center">
              <div class="col-md-12">
                <p>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                  <script>
                    document.write(new Date().getFullYear());
                  </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
              </div>

            </div>
          </div>
        </footer>
      </div>

      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery-ui.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/jquery.magnific-popup.min.js"></script>
      <script src="js/aos.js"></script>

      <script src="js/main.js"></script>

</body>

</html>