<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login V1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="style4.css">
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/pps.jpg" alt="IMG" width="250px" height="250px" style="border-radius: 30%; position: relative; top: -70px;">
        </div>

        <form class="login100-form validate-form" method="POST" action="" style=" position: relative; top: -70px;">
          <span class="login100-form-title">
          Login
          </span>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="btn-login">
              Login
            </button>
          </div>



        </form>
      </div>
    </div>
  </div>




  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>

</html>


<?php
$connection = mysqli_connect("localhost", "root", "", "sms6");

if (isset($_POST['btn-login'])) {
  
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  ///////////////////admin
  $query = " SELECT * FROM admin_tb WHERE username= '$username' and password='$password' ";
  $query_run = mysqli_query($connection, $query);

  
  if (mysqli_num_rows($query_run) > 0) {
    $_SESSION['login_admin'] = $username; // Initializing Session
    header("location: Application/admin/profile.php");
  }
  
  
  //////////////parent
  $query = " SELECT * FROM parent_tb WHERE username= '$username' and password='$password' ";
  $query_run = mysqli_query($connection, $query);
  
  if (mysqli_num_rows($query_run) > 0) {
    $_SESSION['login_parent'] = $username; // Initializing Session
    header("location: Application/parent/profile.php");
  }

  /////////////////student
  $query = " SELECT * FROM student_tb WHERE username= '$username' and password='$password' ";
  $query_run = mysqli_query($connection, $query);
  
  if (mysqli_num_rows($query_run) > 0) {
    $_SESSION['login_std'] = $username; // Initializing Session
    header("location: Application/student/profile.php");
  }

  /////////////////teacher

  $query = " SELECT * FROM teacher_tb WHERE username= '$username' and password='$password' ";
  $query_run = mysqli_query($connection, $query);
  if (mysqli_num_rows($query_run) > 0) {
    $_SESSION['login_teacher'] = $username; // Initializing Session
    header("location: Application/teacher/profile.php");
  }
} else {
  echo "Username or Password is invalid";
}


?>
