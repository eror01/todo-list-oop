<?php
include "includes/admin_header.php";
include "includes/admin_nav.php"; 
include "../classes/AdminController.php"; 
$user = new AdminController(); ?>

<div class="admin-wrapper">
  <div class="admin-wrapper-padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="admin-title">
            <h1>Welcome Admin: <span class="text-warning"><?php echo ucfirst($_SESSION['username']); ?></span></h1>
            <h3>Brief overview of our App stats</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Users</h5>
              <p class="card-text">Few users using our App</p>
            </div>
            <ul class="list-group list-group-flush">
              <?php $user->displayFourUsersAndItemCount(); ?>
            </ul>
            <div class="card-body">
              <a href="./all_users.php" class="card-link">All Users</a>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Some Todos</h5>
              <p class="card-text">Couple of user todo's</p>
            </div>
            <ul class="list-group list-group-flush">
              <?php $user->displayFourTodoItems(); ?>
            </ul>
            <div class="card-body">
              <a href="./all_todos.php" class="card-link">All Todos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "includes/admin_footer.php"; ?>