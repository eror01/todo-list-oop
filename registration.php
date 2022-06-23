<?php 
include "./includes/header.php"; 
include "classes/user.php"; 

$username = "";
$email = "";

if(count($_POST) > 0) {
  $User = new User();
  $errors = $User->register($_POST); 
  extract($_POST);
}

?>
<?php if(isset($errors) && is_array($errors) && count($errors) > 0) : ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach($errors as $error) : ?>
      <?php echo $error; ?><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
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
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
          </div>
          <div class="form-group mt-2">
            <label for="email" class="mb-1 ">Email</label>
            <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
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
