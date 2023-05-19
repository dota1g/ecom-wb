<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Windblume - Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
  </style>


  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>
<?php
session_start();
include("config.php");
$error = "";

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = test_input($_POST["user"]);
  $pass = test_input($_POST["pass"]);

  $myuser = mysqli_real_escape_string($db, $user);
  $mypass = mysqli_real_escape_string($db, $pass);
  $sql = "SELECT * FROM users WHERE (username = '$myuser' OR email='$myuser') and userPassword = sha2('$mypass', 256) limit 1";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $count = mysqli_num_rows($result);

  if ($count == 1) {
    $_SESSION['login_user'] = $myuser;
    header("location:shop.php");
  } else {
    $error = "Username or password is invalid";
  }
}
?>

<body class="text-center">


  <main class="form-signin">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <a href="index.php">
        <img class="mb-4" src="images/header.png" alt="" width="150" height="auto" />
      </a>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <p class="text-center" style="color: red;"><?php echo $error; ?></p>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="user" placeholder="name@example.com">
        <label for="floatingInput">Username/Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox invisible mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <input type="submit" value="Log in" class="w-100 btn btn-lg btn-primary" />
      <div>
        <label>
          <p><br>Don't have an account yet? <a href="register.php">Register here!</a></p>
        </label>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; Windblume 2023</p>
    </form>
  </main>



</body>

</html>