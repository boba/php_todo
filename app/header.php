<html>

<head>
  <title>TODO List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="app.css">
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="/">TODO List</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">View All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/create.php">Add</a>
        </li>
      </ul>
    </div>
  </nav>

  <main role="main" class="container">
    <?php if ($_SERVER['SCRIPT_NAME'] === "/app/index.php") { ?>
    <div class="jumbotron">
      <h1>TODO List</h1>
      <p class="lead">Let's get busy!</p>
      <a class="btn btn-lg btn-primary" href="create.php" role="button">Add TODO</a>
    </div>
    <?php } ?>
    
    <div class="col-md-8 offset-md-2">
