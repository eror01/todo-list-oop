<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="../index.php">Todo List - Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php
        if (strpos($_SERVER['REQUEST_URI'], "index.php") !== false) : ?>
          <li class="nav-item">
            <a class="nav-link" href="./all_users.php">All Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./all_todos.php">All Todos</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="./all_users.php">All Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./all_todos.php">All Todos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Dashboard</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>