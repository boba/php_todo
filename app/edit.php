<?php
  require_once 'todo.php';
  require_once 'check_string.php';
  require_once 'snackbar.php';
?>

<?php include "header.php" ?>
  
<?php
if(isset($_GET['id'])){
  $id = check_string($_GET['id']);

  try {
    
    $model = ToDo::find($id);
    
    if(isset($_POST['submit'])){
      $model->name = check_string($_POST['name']);
      $model->detail = check_string($_POST['detail']);

      $model->save();
      
      treatYoSelf("TODO", "Updated");
    } 
    
    echo <<<EOT
          <form action="edit.php?id=$model->id" method="POST">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="$model->name" placeholder="Enter your TODO" >
              <small id="nameHelp" class="form-text text-muted">What do you need to get done?</small>
            </div>
            <div class="form-group">
              <label for="detail">Detail</label>
              <textarea class="form-control" id="detail" name="detail" rows="3">$model->detail</textarea>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Edit</button>
          </form>
EOT;
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage(). "<br/>";
    die();
  }
  
}
?>

<?php include "footer.php" ?>
