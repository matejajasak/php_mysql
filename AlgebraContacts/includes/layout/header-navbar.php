<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $title ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php
        $user = new User();
        if ($user->check()){ //ako je user ulogiran
      ?>

      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all-users.php">Korisnici</a>
      </li>
      
      <?php
        }
      ?>

      </ul>
    <ul class="navbar-nav ml-auto">
      <?php
        if (!$user->check()){ //ako user nije ulogiran
      ?>

      <li class="nav-item">
        <a href="login.php" class="nav-link">Sign In</a>
      </li>
      <li class="nav-item">
        <a href="register.php" class="nav-link">Create an Account</a>
      </li>
      <?php
        }else{
          ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              <span class="glyphicon glyphicon-user"> 
                <?php echo $user->data()->name; ?>
              </span>
              <span class="carret"></span>
          </a>
            <ul class="dropdown-menu">
              <li class="dropdown-item"> <a href="logout.php">Logout</a> </li>
            </ul>
          </li>
      <?php
        }
      ?>

    </ul>
  </div>
</nav>
<div class="container">
