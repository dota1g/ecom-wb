<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
</head>
<?php
session_start();
include("config.php");
if (isset($_SESSION['login_user'])) {
  $user = $_SESSION['login_user'];
  $usersql = "SELECT * from admins where username ='$user' or email = '$user' limit 1";
  $userResult = mysqli_query($db, $usersql);
  $userRow = mysqli_fetch_assoc($userResult);
} else {
  header('Location:index.php');
}

$getAllMails = "SELECT * from email";
$resultxdd = mysqli_query($db, $getAllMails);
$mailCount = mysqli_num_rows($resultxdd);

$productsql = "SELECT * from products where isProductAvailable = 1";
$productresult = mysqli_query($db, $productsql);
$productCount = mysqli_num_rows($productresult);

$getAllUsers = "SELECT * from users";
$resultusers = mysqli_query($db, $getAllUsers);
$userCount = mysqli_num_rows($resultusers);

$joinTheseStupidTables = "SELECT orderID,
                                orders.userID as ouid,
                                users.username as username,
                                users.firstName as firstName,
                                users.lastname as lastname,
                                products.productName as productName,
                                products.productImg as productImg,
                                products.productPrice as price,
                                dateOrdered,
                                orderStatus,
                                dateDelivered
                                from ((orders inner join users on orders.userID = users.userID)
                                inner join products on orders.productID = products.productID)";
$resultorders = mysqli_query($db, $joinTheseStupidTables);
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="starter.php" class="brand-link">
        <img src="../user/images/header.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin Portal</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
            <a href="msg-read" class="d-block">Admin</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Customer Service
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pending-orders.php" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="messages.php" class="nav-link ">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Messages</p>
                  </a>
                </li>
                <li class="nav-item invisible">
                  <a href="reviews.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Reviews</p>
                  </a>
                </li>
              </ul>
            </li>
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <li class="nav-item">
              <a href="addproduct.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Add a service</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="deleteservice.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>View/Edit/Delete a service</p>
              </a>
            </li>
          </ul>
          <div class="fixed-bottom"><a href="login.php" type="button" class="btn-primary btn-lg mb-4 pl-3 pr-3" style="margin-left: 72px;">Logout</a></div>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View orders</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($resultorders)) {

                    echo " <tr data-widget=\"expandable-table text-center\" aria-expanded=\"false\">
                        <td>" . $row['orderID'] . "</td>
                        <td>" . $row['firstName'] . " " . $row['lastname'] . "</td>
                        <td>" . $row['dateOrdered'] . "</td>
                        <td>" . $row['productName'] . "</td>
                        <td>₱" . $row['price'] . "</td>";
                    if ($row['orderStatus'] == 0) {
                      echo "<td> Pending </td>";
                    } else if ($row['orderStatus'] == 1) {
                      echo " <td> Negotiation ongoing </td>";
                    } else if ($row['orderStatus'] == 2) {
                      echo "<td> Work in progress </td>";
                    } else if ($row['orderStatus'] == 3) {
                      echo "<td> Completed </td>";
                    } else if ($row['orderStatus'] == 4) {
                      echo "<td> Cancelled </td>";
                    }
                    if ($row['orderStatus'] == 0) {
                      echo "<td> <div class=\"d-flex flex-row\">
                      <div class=\"m-1 align-items-center ml-1\">
                        <a href=\"composemsg.php?orderID=".$row['orderID']."&userID=".$row['ouid']."\" type=\"button\" class=\"btn btn-primary ml-1\">
                          Contact
                        </a>
                      </div>
                      <div class=\"m-1 align-items-center ml-1\">
                      <a href=\"denyordersql.php?id=".$row['orderID']."\" type=\"button\" class=\"btn btn-danger ml-1\">
                        Reject
                      </a>
                    </div>
                    </div>
                      </td>";
                    } else if ($row['orderStatus'] == 1) {
                      echo " <td class=\"text-center\"> <div class=\"d-flex flex-row\">
                      <div class=\"m-1 align-items-center ml-1\">
                        <a href=\"composemsg.php?orderID=".$row['orderID']."&userID=".$row['ouid']."\" type=\"button\" class=\"btn btn-primary ml-1\">
                          Contact
                        </a>
                      </div>
                      <div class=\"m-1 align-items-center ml-1\">
                      <a href=\"markasWIPsql.php?id=".$row['orderID']."\" type=\"button\" class=\"btn btn-success ml-1\">
                        Accept
                      </a>
                    </div>
                      <div class=\"m-1 align-items-center ml-1\">
                      <a href=\"denyordersql.php?id=".$row['orderID']."\" type=\"button\" class=\"btn btn-danger ml-1\">
                        Reject
                      </a>
                    </div>
                    </div>
                      </td>";
                    } else if ($row['orderStatus'] == 2) {
                      echo "<td class=\"text-center\">  <div class=\"d-flex flex-row\">
                      <div class=\"m-1 align-items-center ml-1\">
                        <a href=\"composemsg.php?orderID=".$row['orderID']."&userID=".$row['ouid']."\" type=\"button\" class=\"btn btn-primary ml-1\">
                          Contact
                        </a>
                      </div>
                      <div class=\"m-1 align-items-center ml-1\">
                      <a href=\"markascompletedsql.php?id=".$row['orderID']."\" type=\"button\" class=\"btn btn-success ml-1\">
                        Completed
                      </a>
                    </div>
                      <div class=\"m-1 align-items-center ml-1\">
                      <a href=\"denyordersql.php?id=".$row['orderID']."\" type=\"button\" class=\"btn btn-danger ml-1\">
                        Cancel
                      </a>
                    </div>
                    </div>
                      </td>";
                    } else if ($row['orderStatus'] == 3) {
                      echo "<td class=\"text-center\"> N/A </td>";
                    } else if ($row['orderStatus'] == 4) {
                      echo "<td class=\"text-center\"> N/A </td>";
                    }
                    //   <td>".($row['orderStatus'] == 1 ?
                        // "<div class=\"d-flex\">
                        // <div class=\"m-1 align-items-center ml-1\">
                        //   <a href=\"composemsg.php?orderID=".$row['orderID']."&userID=".$row['ouid']."\" type=\"button\" class=\"btn btn-primary ml-1\">
                        //     Contact
                        //   </a>
                        // </div>
                        // </div>" : "
                    //     <div class=\"d-flex\">
                    //       <div class=\"m-1 align-items-center d-flex ml-1\">
                    //       <a href=\"composemsg.php?orderID=".$row['orderID']."&userID=".$row['ouid']."\" type=\"button\" class=\"btn btn-primary ml-1\">
                    //         Contact
                    //       </a>
                    //   </div>
                    //   <div class=\"m-1 align-items-center d-flex ml-1\">
                    //       <button type=\"button\" class=\"btn btn-success ml-1\">
                    //         Accept
                    //       </button>
                    //     </div>
                    //     </div>")."
                    //   </td>
                    // </tr>");
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>