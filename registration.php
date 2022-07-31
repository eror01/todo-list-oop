<?php 
include "./includes/header.php"; 

if(isset($_POST['create_user'])) {
  $username = $_POST['username'];
  $username = preg_replace('/\s+/', '_', $username);
  $user_email = $_POST['email'];
  $user_role = $_POST['user_role'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirm_password'];

  include "classes/Db.php";
  include "classes/Register.php";
  include "classes/RegisterController.php";
  $db = new Db();
  $user = new RegisterController($username, $user_email, $user_role, $password, $cpassword);

  $user->validateUser();
}
?>
<div class="wrapper bg-light">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-10">
        <h2 class="registration__heading text-center">Registration</h2>
        <hr>
      </div>
      <div class="col-10">
        <form action="" method="POST">
          <div class="form-group mt-2">
            <label for="username" class="mb-1 ">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
          </div>
          <div class="form-group mt-2">
            <label for="email" class="mb-1 ">Email</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
            <div class="invalid-feedback">Email is required!</div>
          </div>
          <div class="form-group mt-3">
            <select class="form-select" name="user_role" aria-label="Default select example">
              <option value="subscriber" selected>Open this select menu</option>
              <option value="contributor">Contributor</option>
              <option value="subscriber">Subscriber</option>
            </select>
          </div>
          <div class="form-group mt-2">
            <label for="password" class="mb-1 ">Password</label>
            <input type="password" id="password" class="form-control password" required placeholder="Enter your pasword" name="password">
          </div>
          <div class="form-group mt-2" class="mb-1">
            <label for="confirm_password" class="mb-1 ">Confirm password</label>
            <input type="password" id="confirm_password" class="form-control" required placeholder="Confirm password" name="confirm_password">
          </div>
          <input type="submit" value="Register" name="create_user" class="btn btn-primary w-100 mt-4">
        </form>
      </div>
    </div>
  </div>
</div>
