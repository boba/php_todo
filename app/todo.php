<?php require_once("db_connect.php"); ?>
<?php

class ToDo {
  protected $id = null;
  protected $name = null;
  protected $detail = null;
  protected $created = null;
  protected $modified = null;
  
  function __construct() {
    $this->name = null;
    $this->detail = null;
    $this->created = null;
    $this->modified = null;
  }
  
  function __destruct() {
    $this->name = null;
    $this->detail = null;
    $this->created = null;
    $this->modified = null;
  }
  
  public function __set($name, $value)
  {
    if(isset($this->$name)) {
      $this->$name = $value;
    } else {
      $trace = debug_backtrace();
      $error = 'Undefined property via __get(): ' . $name .
          ' in ' . $trace[0]['file'] .
          ' on line ' . $trace[0]['line'];
      trigger_error($error, E_USER_NOTICE);
      die($error);
    }
  }

  public function __get($name)
  {
    if(isset($this->$name)) {
      return $this->$name;
    }

    $trace = debug_backtrace();
    $error = 'Undefined property via __get(): ' . $name .
        ' in ' . $trace[0]['file'] .
        ' on line ' . $trace[0]['line'];
    trigger_error($error, E_USER_NOTICE);
    die($error);
  }
  
  public function __call($name, $arguments) {
    if ($name === 'delete') {
      call_user_func(array($this, 'deleteObject'));
    }
  }

  public function setId($value) {
    $this->id = $value;
  }

  public function getId() {
    return $this->id;
  }

  public function setName($value) {
    $this->name = $value;
  }

  public function getName() {
    return $this->name;
  }

  public function setDetail($value) {
    $this->detail = $value;
  }

  public function getDetail() {
    return $this->detail;
  }

  public function setCreated($value) {
    $this->created = $value;
  }

  public function getCreated() {
    return $this->created;
  }

  public function setModified($value) {
    $this->modified = $value;
  }

  public function getModified() {
    return $this->modified;
  }


  // load all the models
  public static function all() {
    $models = array();
    try {
      $dbh = db();

      $sql = "SELECT id, name, detail, created, modified FROM todo ORDER BY id ASC";

      foreach ($dbh->query($sql) as $row) {
        $model = new ToDo();

        $model->id = $row['id'];
        $model->name = $row['name'];
        $model->detail = $row['detail'];
        $model->created = $row['created'];
        $model->modified = $row['modified'];

        array_push($models, $model);
      }

      $dbh = null;

    } catch (PDOException $e) {
      throw new Exception("Error: Unable to load models: " . $e->getMessage(), $e);
    }
    
    return $models;
  }

  // load a model by id
  public static function find($id) {
    $model = new ToDo();
    try {
      
      $dbh = db();
      
      $statement = $dbh->prepare("SELECT id, name, detail, created, modified FROM todo WHERE id = :id");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      
      if ($statement->execute()) {
        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
          $model->id = $row['id'];
          $model->name = $row['name'];
          $model->detail = $row['detail'];
          $model->created = $row['created'];
          $model->modified = $row['modified'];

        }
      } else {
        throw new Exception("Error: Unable to load model: (" . $statement->errorCode() . ") " . $statement->errorInfo()[2]);
      }
      
      $statement = null;
      $dbh = null;
      
    } catch (PDOException $e) {
      throw new Exception("Error: Unable to load model: " . $e->getMessage(), $e);
    }
    
    return $model;
  }

  public static function create($name, $detail) {
    $id = null;
    
    try {
      $dbh = db();
      
      $statement = $dbh->prepare("INSERT INTO todo(name, detail, created) VALUES (:name, :detail, NOW())");

      $statement->bindParam(':name', $name, PDO::PARAM_STR);
      $statement->bindParam(':detail', $detail, PDO::PARAM_STR);
      
      if ($statement->execute()) {
        $id = $dbh->lastInsertId();
      } else {
        throw new Exception("Error: Unable to create model: (" . $statement->errorCode() . ") " . $statement->errorInfo()[2]);
      }
      
      $statement = null;
      $dbh = null;
      
    } catch (PDOException $e) {
      throw new Exception("Error: Unable to create model: " . $e->getMessage(), $e);
    }

    return ToDo::find($id);
  }
  
  // update the model with the latest info from the database
  public function update() {
    $updated = ToDo::find($this->id);
    $this->id = $updated->id;
    $this->name = $updated->name;
    $this->detail = $updated->detail;
    $this->created = $updated->created;
    $this->modified = $updated->modified;
  }
  
  // save a model
  public function save() {
    try {
      $dbh = db();

      $statement = $dbh->prepare("UPDATE todo SET name = :name, detail = :detail WHERE id = :id");

      $statement->bindParam(':id', $this->id, PDO::PARAM_INT);
      $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
      $statement->bindParam(':detail', $this->detail, PDO::PARAM_STR);

      if ($statement->execute()) {
        $this->update();
      } else {
        throw new Exception("Error: Unable to save model: (" . $statement->errorCode() . ") " . $statement->errorInfo()[2]);
      }

      $statement = null;
      $dbh = null;

    } catch (PDOException $e) {
      throw new Exception("Error: Unable to save model: " . $e->getMessage(), $e);
      die();
    }
  }

  // delete this model
  public function deleteObject() {
    ToDo::delete($this->id);
  }

    // delete a model by id
  public static function delete($id) {
    try {
      $dbh = db();

      $statement = $dbh->prepare("DELETE FROM todo WHERE id = :id");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      
      if ($statement->execute()) {
        $id = $dbh->lastInsertId();
      } else {
        throw new Exception("Error: Unable to delete model: (" . $statement->errorCode() . ") " . $statement->errorInfo()[2]);
      }

      $statement = null;
      $dbh = null;
      
    } catch (PDOException $e) {
      echo "Error: Execute failed: " . $e->getMessage(). "<br/>";
      die();
    }
  }

  
}