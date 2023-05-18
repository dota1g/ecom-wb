<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('config.php');
if (isset($_SESSION['login_user'])) {
  $user = $_SESSION['login_user'];
  $usersql = "SELECT * from users where username ='$user' or email = '$user' limit 1";
  $userResult = mysqli_query($db, $usersql);
  $userRow = mysqli_fetch_assoc($userResult);
} else {
  header('Location:login.php');
}

$sql = "SELECT * from email where userID=" . $userRow['userID'] . "";
$result = mysqli_query($db, $sql);
$getUnreadMails = "SELECT * from email where userID=" . $userRow['userID'] . " AND didUserReadMsg = 0";
$resultxdd = mysqli_query($db, $getUnreadMails);
$unreadMailsCount = mysqli_num_rows($resultxdd);

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userID = $userRow['userID'];
  $subject = test_input($_POST["subject"]);
  $content = test_input($_POST["content"]);

  if (isset($_POST['oID'])) {
    $orderID = $_POST['oID'];
    $emailsql = "INSERT into email (`userID`, `emailSubject`, `emailContent`, `orderID`) VALUES ('$userID','$subject','$content', '$orderID')";
    $query = mysqli_query($db, $emailsql);
    header('Location:inbox.php');
  } else {
    $emailsql = "INSERT into email (`userID`, `emailSubject`, `emailContent`) VALUES ('$userID','$subject','$content')";
    $query = mysqli_query($db, $emailsql);
    header('Location:inbox.php');
  }
}
?>

<head>
  <title>Windblume | Inbox></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/email.css" />
  <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">

</head>

<body>

  <div class="site-wrap">
    <div class="site-navbar" role="banner">
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
                    echo "<li><a href=\"login.php\"><span class=\"icon icon-person\"></span></a></li>";
                  } else {
                    echo "<li>Hello, <a href=\"login.php\">" . $userRow['firstName'] . "</a><a href=\"logout.php\">(Logout)</a></li>";
                  }
                  ?>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
                    </a>
                  </li>
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
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
      </header>

      <div class="content-wrapper m-5">
        <div class="bg-light py-3">
          <div class="container">
            <div class="row">
              <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Inbox</strong></div>
            </div>
          </div>
        </div>
        <div class="site-section m-5">
          <section class="content">
            <div class="row">
              <div class="col-md-3">
                <p><a href="compose.php" class="btn btn-primary text-light btn-block mb-3">Compose</a></p>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Folders</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item active">
                        <a href="#" class="nav-link">
                          <i class="fas fa-inbox"></i> Inbox
                          <?php if ($unreadMailsCount > 0) {
                            echo "<span class=\"count badge badge-primary float-right\">" . $unreadMailsCount . "</span>";
                          } else {
                            echo "";
                          } ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-envelope"></i> Sent
                        </a>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h3 class="card-title">Compose New Message / Reply</h3>
                  </div>
                  <!-- /.card-header -->
                    <div class="card-body">
                    <?php 
                      if(isset($_GET['orderID'])){
                        $ID = $_GET['orderID'];
                        $getOrderDetails = "SELECT *, products.productName as productName FROM (orders INNER join products on products.productID = orders.productID) WHERE orderID = '$ID';";
                        $orderResult = mysqli_query($db, $getOrderDetails);
                        $itsfuckinrow = mysqli_fetch_assoc($orderResult);
                        echo "<div class=\"alert alert-info\" role=\"alert\">
                        You are messaging about this order: ".$itsfuckinrow['productName']."<br/>
                        Ordered at ".$itsfuckinrow['dateOrdered']."
                      </div>
                      <div class=\"form-group\">
                        Order ID
                        <input class=\"form-control\" value=\"$ID\" name=\"oID\" readonly>
                      </div>";
                      }
                      ?>
                      <div class="form-group">
                        <input class="form-control" placeholder="To: Admins" readonly>
                      </div>
                      <div class="form-group">
                        <input class="form-control" placeholder="Subject:" name="subject">
                      </div>
                      <div class="form-group">
                        <textarea id="compose-textarea" class="form-control" style="height: 300px" name="content">
                        </textarea>
                      </div>
                      <div class="form-group">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                      </div>
                      <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                    </div>
                  </form>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
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