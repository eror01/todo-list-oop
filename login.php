<?php 
include "./includes/header.php"; 

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  include "classes/Db.php";
  include "classes/Login.php";
  include "classes/LoginController.php";
  $login = new LoginController($username, $password);

  $login->loginUser();
} ?>
<?php  

if(isset($_GET['registration'])) {
  echo '<div class="alert alert-success mb-0" role="alert">You have successfully registered!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if(isset($_GET['error'])) {
  $error = $_GET['error'];
  if($error == 'user_not_found') {
    echo '<div class="alert alert-danger mb-0" role="alert">User not found!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } elseif($error == 'wrong_password') {
    echo '<div class="alert alert-danger mb-0" role="alert">Password is incorrect!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}

?>
<div class="wrapper bg-light">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-10">
        <h2 class="registration__heading text-center">Login</h2>
        <hr>
      </div>
      <div class="col-10">
        <form action="" method="POST">
          <div class="form-group mt-2">
            <label for="username" class="mb-1 ">Username</label>
            <input type="text" id="username" class="form-control" name="username" required>
            <div class="invalid-feedback">Username is required!</div>
          </div>
          <div class="form-group mt-2">
            <label for="password" class="mb-1 ">Password</label>
            <input type="password" id="password" class="form-control" name="password" required>
            <div class="invalid-feedback">Password is required!</div>
          </div>
          <div class="form-group text-end mt-4">
            <input type="submit" value="Log In" name="login" class="btn btn-dark w-25">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>