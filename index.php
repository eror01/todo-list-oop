<?php
include "./includes/header.php";
include "./includes/nav.php"; ?>

<div class="wrapper bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <div class="card card-home" style="width: 25rem;">
            <div class="card-body">
              <h5 class="card-title">Welcome to Todo List App</h5>
              <h6 class="card-subtitle mb-2 text-muted">Looks like you are not logged in.</h6>
              <p class="card-text">If you want to create Your Todo List you need to Log in or Register</p>
              <a href="login.php" class="card-link">Log In</a>
              <a href="registration.php" class="card-link">Register</a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php
include "./includes/footer.php"; ?>