<?php
include "./includes/header.php";
include "./includes/nav.php"; 

if(isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
  $loggedIn = $_SESSION['loggedIn'];
  $username = $_SESSION['username']; 
}

?>

<div class="wrapper bg-light <?php if($loggedIn) { echo "wrapper-todo"; } else { echo ""; } ?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php if(!$loggedIn) : ?>
          <div class="card card-home" style="width: 25rem;">
            <div class="card-body">
              <h5 class="card-title">Welcome to Todo List App</h5>
              <h6 class="card-subtitle mb-2 text-muted">Looks like you are not logged in.</h6>
              <p class="card-text">If you want to create Your Todo List you need to Log in or Register</p>
              <a href="login.php" class="card-link">Log In</a>
              <a href="registration.php" class="card-link">Register</a>
            </div>
          </div>
        <?php else : ?>
          <div class="todo-app">
            <?php include "./includes/todo_list.php"; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php
include "./includes/footer.php"; ?>