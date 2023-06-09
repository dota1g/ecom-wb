<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <title>Windblume</title>
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
  include('config.php');
  if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];
    $usersql = "SELECT * from users where username ='$user' or email = '$user' limit 1";
    $userResult = mysqli_query($db, $usersql);
    $userRow = mysqli_fetch_assoc($userResult);
    $userID = $userRow['userID'];
    $sql = "SELECT orderID, 
            products.productName as productName,
            products.productPrice as productPrice,
            products.productImg as productImg,
            orderStatus,
            dateOrdered,
            users.username as username
            from ((orders INNER JOIN users on orders.userID = users.userID)
                  INNER JOIN products on orders.productID = products.productID)
                  where users.userID = '$userID' order by dateOrdered desc";
    $result = mysqli_query($db, $sql);

    $getUnreadMails = "SELECT * from email where userID=" . $userRow['userID'] . " AND didUserReadMsg = 0 and isFromAdmin = 1";
    $resultxdd = mysqli_query($db, $getUnreadMails);
    $unreadMailsCount = mysqli_num_rows($resultxdd);
  }

  ?>

<body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
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
              <!-- <ul class="dropdown">
                  <li><a href="#">Menu One</a></li>
                  <li><a href="#">Menu Two</a></li>
                  <li><a href="#">Menu Three</a></li>
                  <li class="has-children">
                    <a href="#">Sub Menu</a>
                    <ul class="dropdown">
                      <li><a href="#">Menu One</a></li>
                      <li><a href="#">Menu Two</a></li>
                      <li><a href="#">Menu Three</a></li>
                    </ul>
                  </li>
                </ul> -->
            </li>
            <li>
              <a href="about.php">About</a>
              <!-- <ul class="dropdown">
                  <li><a href="#">Menu One</a></li>
                  <li><a href="#">Menu Two</a></li>
                  <li><a href="#">Menu Three</a></li>
                </ul> -->
            </li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Orders</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <?php
          echo "<form class=\"col-md-12\" method=\"post\">
        <div class=\"site-blocks-table\">
          <table class=\"table table-bordered\">
            <thead>
              <tr>
                <th class=\"product-thumbnail\">Image</th>
                <th class=\"product-name\">Product</th>
                <th class=\"product-price\">Price</th>
                <th class=\"product-total\">Date Ordered</th>
                <th class=\"product-remove\">Status</th>
                <th class=\"product-remove\">Actions</th>
              </tr>
            </thead>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "
        <tbody>
          <tr>
            <td class=\"product-thumbnail\">
              <img src=\"../images/" . $row['productImg'] . "\" alt=\"Image\" class=\"img-fluid\">
            </td>
            <td class=\"product-name\">
              <h2 class=\"h5 text-black\">" . $row['productName'] . "</h2>
            </td>
            <td>₱" . $row['productPrice'] . "</td>
            <td>" . $row['dateOrdered'] . "</td>";
            if ($row['orderStatus'] == 0) {
              echo "<td> Pending </td>";
            } else if ($row['orderStatus'] == 1) {
              echo " <td class=\"text-primary\"> Negotiation ongoing </td>";
            } else if ($row['orderStatus'] == 2) {
              echo "<td class=\"text-success\"> Work in progress </td>";
            } else if ($row['orderStatus'] == 3) {
              echo "<td class=\"text-success\"> Completed </td>";
            } else if ($row['orderStatus'] == 4) {
              echo "<td class=\"text-danger\" title=\"Cancelled orders are automatically refunded.\"> Cancelled &#x1F6C8  </td>";
            }
            if ($row['orderStatus'] == 3 || $row['orderStatus'] == 4){
            echo "<td><a href=\"composemsg.php?orderID=".$row['orderID']."\" class=\"btn btn-primary disabled btn-sm\">Message</a></td>";
            } else {
              echo "<td><a href=\"composemsg.php?orderID=".$row['orderID']."\" class=\"btn btn-primary btn-sm\">Message</a>
              <a href=\"denyordersql.php?id=".$row['orderID']."\" class=\"btn btn-danger btn-sm\">Cancel</a></td>";
            }
          echo "</tr>
        </tbody>";
          }
          echo "</table>
          </div>
        </form>";
          ?>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6">
                <a href="shop.php" class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</a>
              </div>
            </div>
            <div class="row invisible">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Apply Coupon</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5 invisible">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">₱149.00</strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">₱149.00</strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                  </div>
                </div>
              </div>
            </div>
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