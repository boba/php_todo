<?php
  require_once "todo.php";
  require_once "check_string.php";
?>

<?php include "header.php" ?>

<?php
  if(isset($_GET['id'])) {
    $id = check_string($_GET['id']);
    
    try {
      $model = ToDo::find($id);
      
      echo <<<EOT
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <h2>$model->name</h2>
                <hr/>
                <p>$model->detail</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 offset-md-7">
                <small>Created: $model->created</small><br/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 offset-md-7">
                <small>Modified: $model->modified</small><br/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 offset-md-1"><hr/></div>
            </div>
            <div class="row">
              <div class="col-sm-1 offset-sm-8"><button type="button"><a href="edit.php?id=$model->id">Edit</a></button></div>
              <div class="col-sm-1"><button type="button"><a href="delete.php?id=$model->id">Delete</a></button></div>
            </div>
            <div class="row">
              <div class="col-md-10 offset-md-1"><hr/></div>
            </div>
            <div class="row text-center">
              <div class="col-md-10 offset-md-1">
                <a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif&size=med" class="center-block img-responsive"></a>
              </div>
            </div>
EOT;
      
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage(). "<br/>";
      die();
    }
    
  }
?>



<?php include "footer.php" ?>
