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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
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
              <div class="col-md-6 margintop10">
                <img src="assets/dist/css/login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid mt-5">
              </div>
              <div class="col-md-6 contents">
                <div class="screenregister ml-5">
                  <div class="screen__content p-5 mb-5">
                    <div class="">
                      <div class="mb-4">
                        <h3 class="text-center mb-3">Sign Up</h3>
                        <div class="text-center">
                          Welcome to iTask
                        </div>
                      </div>
                    </div>

                    <form action="" id="manage_user">
                      <div class="form-group first mb-2 mt-5">
                        <input class="form-control" type="text" name="firstname" placeholder="First Name" required value="<?php echo isset($firstname) ? $firstname : '' ?>">

                      </div>
                      <div class="form-group first mb-2">
                        <input class="form-control" type="text" name="lastname" placeholder="Last Name" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
                      </div>
                      <div class="form-group first mb-2">
                        <input class="form-control" type="email" name="email" placeholder="Email" required value="<?php echo isset($email) ? $email : '' ?>">
                      </div>
                      <div class="form-group first mb-2">
                        <input class="form-control" type="password" name="password" placeholder="Password" <?php echo !isset($id) ? "required" : '' ?>>
                      </div>
                      <div class="form-group last mb-2 fw-bold">
                        <input class="form-control" type="password" name="cpass" placeholder="Confirm Password" <?php echo !isset($id) ? "required" : '' ?>>
                      </div>
                      <center>
                        <small id="pass_match" data-status=''></small>
                      </center>
                      <p style="color:black;font-weight:bolder">User Role</p>
                      <div class="form-group">
                        <select name="type" id="type" class="custom-select custom-select-sm">
                          <option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Employee</option>
                          <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Project Manager</option>
                        </select>
                      </div>
                      <input type="submit" value="Register" class="btn btn-block btn-primary mt-5">
                      <div class="text-center"><br>
                        Already have an account? <a class="text-black" href="login.php">Login</a>
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
    $('[name="password"],[name="cpass"]').keyup(function() {
      var pass = $('[name="password"]').val()
      var cpass = $('[name="cpass"]').val()
      if (cpass == '' || pass == '') {
        $('#pass_match').attr('data-status', '')
      } else {
        if (cpass == pass) {
          $('#pass_match').attr('data-status', '1').html('<i class="text-success" style="font-weight:bolder">Password Matched.</i>')
        } else {
          $('#pass_match').attr('data-status', '2').html('<i class="text-danger" style="font-weight:bolder">Password does not match.</i>')
        }
      }
    })
    $('#manage_user').submit(function(e) {
      e.preventDefault()
      $('input').removeClass("border-danger")

      $('#msg').html('')
      if ($('[name="password"]').val() != '' && $('[name="cpass"]').val() != '') {
        if ($('#pass_match').attr('data-status') != 1) {
          if ($("[name='password']").val() != '') {
            $('[name="password"],[name="cpass"]').addClass("border-danger")

            return false;
          }
        }
      }
      $.ajax({
        url: 'ajax.php?action=save_user',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
          if (resp == 1) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Registration complete!',
              showConfirmButton: false,
              timer: 1000
            })
            setTimeout(function() {
              location.replace('login.php')
            }, 2000)
          } else if (resp == 2) {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Email already exist!',
              showConfirmButton: false,
              timer: 1400
            })
          }
        }
      })
    })
  </script>
</body>

</html>