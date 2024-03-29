<?php
include "includes/admin_header.php";
include "includes/admin_nav.php"; 
include "../classes/AdminController.php"; 
$user = new AdminController(); ?>
<?php 

if(isset($_GET['delete_user'])) {
  $delete_user = $_GET['delete_user'];
  $user->deleteUser($delete_user);
}
if(isset($_GET['edit_user'])) {
  $edit_user = $_GET['edit_user'];
  if(isset($_POST['update_user'])) {
    $updated_username = $_POST['update_username'];
    $updated_username = preg_replace('/\s+/', '_', $updated_username);
    $updated_role = $_POST['update_role'];
    $user->displayUpdatedUsernameAndRole($updated_username, $edit_user,  $updated_role);
  }
}
?>
<section class="users">
  <div class="container">
    <div class="row">
      <div class="col-4">
        <div class="accordion" id="accordion">
            <?php  
            $user->displayAllUserInfo();
            foreach($user->userAllArr as $user) {
              $user_id = $user['user_id'];
              $user_name = $user['user_name'];
              $user_email = $user['user_email'];
              $user_role = $user['user_role'];
              $user_list_count = $user['user_list_count'];
              ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading-<?php  echo $user_id; ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php  echo $user_id; ?>" aria-expanded="true" aria-controls="collapse<?php  echo $user_id; ?>">
                    <?php  echo $user_name; ?>
                  </button>
                </h2>
                <div id="collapse-<?php echo $user_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo $user_id; ?>" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between">User ID: <span><?php echo $user_id; ?></span></li>
                      <li class="list-group-item d-flex justify-content-between">User Email: <span><?php echo $user_email; ?></span></li>
                      <li class="list-group-item d-flex justify-content-between">User Role: <span><?php echo $user_role ?></span></li>
                      <li class="list-group-item d-flex justify-content-between">User Todo Item Count: <span class="badge bg-primary rounded-pill"><?php echo $user_list_count; ?></span></li>
                      <li class="list-group-item d-flex justify-content-between">
                        <a href="all_users?edit_user=<?php echo $user_id; ?>" class="btn btn-outline-dark">Edit User</a>
                        <a href="all_todos?user_todo=<?php echo $user_id; ?>" class="btn btn-outline-dark">User Todo's</a>
                        <a href="all_users?delete_user=<?php echo $user_id; ?>" class="btn btn-outline-dark">Delete User</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            <?php } ?>
        </div>
      </div>
      <div class="col-8 d-flex flex-column justify-content-center">
        <?php
        $user = new AdminController();
        if (isset($_GET['edit_user'])) {
          $edit_user_id = $_GET['edit_user'];
          $user->editUser($edit_user_id);
          foreach($user->userSingleArr as $user) {
            $user_name = $user['user_name'];
            $user_role = $user['user_role'];
          
        ?>
            <form action="" method="POST">
              <div class="input-group mb-3">
                <label class="input-group-text" for="update_user_role">Roles</label>
                <select class="form-select" name="update_role" id="update_user_role">
                  <option value="<?php echo $user_role; ?>"><?php echo ucfirst($user_role); ?></option>
                  <option value="admin">Admin</option>
                  <option value="contributor">Contributor</option>
                  <option value="subscriber">Subscriber</option>
                </select>
              </div>
              <div class="input-group">
                <input class="form-control" type="text" value="<?php echo $user_name; ?>" name="update_username" id="update_username">
                <span class="input-group-btn">
                  <button class="btn btn-dark" name="update_user" type="submit">Update User</button>
                </span>
              </div>
            </form>
          <?php } ?>
        <?php } ?>
        <?php if (!isset($_GET['edit_user'])) : ?>
          <form action="" method="POST">
            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">Roles</label>
              <select class="form-select" id="inputGroupSelect01">
                <option selected>All Roles</option>
                <option value="admin">Admin</option>
                <option value="contributor">Contributor</option>
                <option value="subscriber">Subscriber</option>
              </select>
            </div>
            <div class="input-group">
              <input class="form-control" type="text" name="username" id="username">
              <span class="input-group-btn">
                <button class="btn btn-dark" name="edit_user" type="submit" disabled>Update User</button>
              </span>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php include "includes/admin_footer.php"; ?>