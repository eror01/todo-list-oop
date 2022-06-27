<?php  
if(!isset($_SESSION['loggedIn'])) {
  $loggedIn = false;
} else {
  $loggedIn = $_SESSION['loggedIn'];
  $admin = $_SESSION['userRole'] === 'admin';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Todo List</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php if($loggedIn) : ?>
          <li class="nav-item">
            <a class="nav-link" href="classes/Logout.php">Logout</a>
          </li>
          <?php if($admin) : ?>
            <li class="nav-item">
              <a class="nav-link" href="admin/index.php">Admin Dashboard</a>
            </li>
          <?php endif; ?>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./registration.php">Register</a>
          </li>
      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>