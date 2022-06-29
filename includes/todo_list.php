<?php
include "classes/TodoController.php";
$todo = new TodoController();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $userID = $_SESSION['userID'];
}
if (isset($_POST['create_todo'])) {
  $todo_content = $_POST['todo-content'];
  $todo_author = $username;
  $todo_content = stripslashes($todo_content);
  $todo->displayTodo($todo_content, $todo_author, $userID);
} 

if(isset($_GET['delete'])) {
  $todo_id = $_GET['delete'];
  $todo->deleteTodo($todo_id, $userID);
}

?>
<section class="todo-list" id="todo">
  <div class="row  justify-content-center mb-4">
    <div class="col-12">
      <h1 class="todo-list_user">
        <?php
        if ($username) {
          echo ucfirst($username) . "'s" . " Todo List";
        } ?>
        <p>Todo Item Count: <span class="badge bg-primary">
          <?php 
          if(isset($userID)) {
            $todo->displayUserListItemCount($userID);
            echo $todo->todoItemCount;
          } else {
            echo '0';
          }
          ?></span></p>
      </h1>
    </div>
    <div class="col-10">
      <?php if (isset($_GET['edit'])) :
        $todo_edit_id = $_GET['edit']; 
        $todo->displayTodoContent($todo_edit_id, $userID);

        if(isset($_POST['update_todo']))  {
          $todo_content_updated = $_POST['todo-content_updated'];
          $todo->displayUpdatedTodo($todo_edit_id, $todo_content_updated);
        }
        ?>
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" class="form-control todo-input" value="<?php echo $todo->todoContent; ?>" name="todo-content_updated" id="todo-content" placeholder="Update your todo" required>
            <span class="input-group-btn">
              <button class="btn btn-dark" name="update_todo" type="submit">Update Todo</button>
            </span>
          </div>
        </form>
      <?php else : ?>
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" class="form-control todo-input" name="todo-content" id="todo-content" placeholder="Create your todo item" required>
            <span class="input-group-btn">
              <button class="btn btn-dark" name="create_todo" type="submit">Add Todo</button>
            </span>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-10">
      <?php
        if(isset($_GET['is_completed'])) {
          $is_completed = $_GET['is_completed'];
          $todo->displayUpdatedTodoIsCompleted($is_completed);
        }
        if (isset($username)) {
          $todo->displayTodosNotComplete($userID);
          if(!empty($todo->todoNotCompleteArr)) {
            foreach($todo->todoNotCompleteArr as $row) {
              $todo_content = $row['todo_content'];
              $todo_id = $row['todo_id'];
              echo "<ul class='todo-list_list'>";
              echo "<li class='todo-list_item'>";
              echo "<p class='todo-list_title'>{$todo_content}</p>";
              echo "<a class='todo-list_link edit' href='index.php?edit={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Todo'><i class='fa-solid fa-file-pen'></i></a>";
              echo "<a class='todo-list_link delete' href='index.php?delete={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Todo'><i class='fa-solid fa-xmark'></i></a>";
              echo "<a class='todo-list_link completed' href='index.php?is_completed={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Completed'><i class='fa-solid fa-check'></i></a>";
              echo "</li>";
              echo "</ul>";
            }
          }
          
        }
       ?>
    </div>
  </div>
  <div class="row justify-content-center py-4">
    <div class="col-12">
      <h1 class="todo-list_user">Completed Todos</h1>
    </div>
    <div class="col-10">
      <?php 

      if (isset($username)) {
        $todo->displayTodosIsComplete($userID);
        if(!empty($todo->todoIsCompleteArr)) {
          foreach($todo->todoIsCompleteArr as $row) {
            $todo_id = $row['todo_id'];
            $todo_content = $row['todo_content'];
            $todo_content = ucfirst($todo_content);
            echo "<ul class='todo-list_list'>";
            echo "<li class='todo-list_item' style='background-color: #DCDCDC;'>";
            echo "<p class='todo-list_title text-decoration-line-through'>{$todo_content}</p>";
            echo "<a class='todo-list_link undo' href='index.php?is_completed_undo={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Undo'><i class='fa-solid fa-rotate-left'></i></a>";
            echo "</li>";
            echo "</ul>";
          }
        }
      }

      if(isset($_GET['is_completed_undo'])) {
        $is_completed_undo = $_GET['is_completed_undo'];
        $todo->changeTodoToNotCompleted($userID);
      } ?>
    </div>
  </div>
</section>