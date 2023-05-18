<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Hugo 0.84.0" />
  <title>Windblume - Register</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    body {
      background-image: url("../admin/images/bg.jpg");
      background-size: cover;
    }
  </style>
  <?php
  session_start();
  include("config.php");
  //login
  $username = $password = "";
  //register
  $fname = $lname = $email = $regusern = $regpass = "";
  //error codes


  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $success = true;

    $fnametemp = test_input($_POST["fname"]);
    $lnametemp = test_input($_POST["lname"]);
    $emailtemp = test_input($_POST["email"]);
    $reguserntemp = test_input($_POST["regusern"]);
    $regpasstemp = test_input($_POST["regpass"]);

    $fname = mysqli_real_escape_string($db, $fnametemp);
    $lname = mysqli_real_escape_string($db, $lnametemp);
    $regusern = mysqli_real_escape_string($db, $reguserntemp);
    $email = mysqli_real_escape_string($db, $emailtemp);
    $regpass = mysqli_real_escape_string($db, $regpasstemp);

    $user_check_query = "SELECT * FROM users WHERE username='$regusern' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
      if ($user['uusername'] === $regusern) {
        $response = array(
          "type" => "error",
          "message" => "Username already exists!"
        );
        $success = false;
      }

      if ($user['email'] === $email) {
        $response = array(
          "type" => "error",
          "message" => "Email already exists!"
        );
        $success = false;
      }
    }

    if ($success) {
      $sql = "INSERT INTO users (username, firstName, lastname, email, userpassword) 
              VALUES('$regusern', '$fname', '$lname', '$email', '$regpass')";
      mysqli_query($db, $sql);
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['email'] = $email;
      $_SESSION['regusern'] = $regusern;
      $_SESSION['regpass'] = $regpass;
      header('location:registerconfirm.php');
      exit();
    }
  }

  ?>

  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet" />
</head>

<body class="text-center">
  <main class="form-signin">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <a href="index.php">
        <img class="mb-4" src="images/header.png" alt="" width="150" height="auto" />
      </a>
      <h1 class="h3 mb-3 fw-normal">Register</h1>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="fname" required />
        <label for="floatingInput">First name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="lname" required />
        <label for="floatingInput">Last name</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required />
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="regusern" required />
        <label for="floatingInput">Username</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="regpass" required />
        <label for="floatingPassword">Password</label>
      </div>
      <input class="w-100 btn btn-lg btn-primary" type="submit" value="Register">
      <div>
        <label>
          <p>
            <br />Already have an account?
            <a href="login.php">Log in here!</a>
          </p>
        </label>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; Windblume 2023</p>
    </form>
  </main>
</body>

</html>