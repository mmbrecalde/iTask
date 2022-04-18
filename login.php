<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {

  $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
  foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
  }
}
ob_end_flush();
?>
<?php
if (isset($_SESSION['login_id']))
  header("location:index.php?page=home");

?>
<?php include 'header.php' ?>

<head>

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/dist/css/login/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <!-- Style -->
  <link rel="stylesheet" href="assets/dist/css/login/css/style.css">
  <link rel="stylesheet" href="assets/dist/css/login/login.css" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="main-w3layouts wrapper">
    <div class="main-agileinfo">
      <div class="agileits-top">
        <div class="content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 margintoploginimage">
                <img src="assets/dist/css/login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
              </div>
              <div class="col-md-6 contents">
                <div class="screen ml-5">
                  <div class="screen__content p-5 mb-5">
                    <div class="">
                      <div class="mb-4">
                        <h3 class="text-center mb-3">Sign In</h3>
                        <div class="text-center">
                          Welcome to iTask
                        </div>
                      </div>
                    </div>

                    <form action="" action="" id="login-form">
                      <div class="form-group first mb-2 mt-5">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                      </div>
                      <div class="form-group last  fw-bold">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">

                      </div>
                      <div class="margintop-20">
                        <input type="submit" value="Log In" class="btn btn-block btn-primary mt-5">
                        <div class="text-center color-primary"><br>
                          Don't have an account yet? <a class="text-black" href="register.php">Register here</a>
                        </div>
                      </div>

                    </form>

                  </div>
                  <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                  </div>
                </div>

              </div>
              <ul class="colorlib-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </div>



  <script>
    $(document).ready(function() {
      $('#login-form').submit(function(e) {
        e.preventDefault()
        start_load()
        if ($(this).find('.alert-danger').length > 0)
          $(this).find('.alert-danger').remove();
        $.ajax({
          url: 'ajax.php?action=login',
          method: 'POST',
          data: $(this).serialize(),
          error: err => {
            console.log(err)
            end_load();

          },
          success: function(resp) {
            if (resp == 1) {
              location.href = 'index.php?page=home';
            } else {
              $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
              end_load();
            }
          }
        })
      })
    })
  </script>
  <?php include 'footer.php' ?>

</body>

</html>