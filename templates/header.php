<?php 
  declare(strict_types=1);
  session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">

      <div class="navbar-header">
        <a class="navbar-brand" href="/webapp/">Bezos</a>
      </div>

      <!-- HREF's that directly have php filename need to be fixed so they dont show the filename -->
      <ul class="nav navbar-nav">
        <li class="active"><a href="/webapp/">Home</a></li>
        <li><a href="/webapp/public/suppliers.php">Suppliers</a></li>
        <li><a href="/webapp/public/products.php">Products</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php 
          if (isset($_SESSION["userid"])) {
            echo '<li><a href="#" class="glyphicon glyphicon-user"> ' . $_SESSION["username"] .'</a></li>';
            echo '<li><a href="/webapp/includes/logout.inc.php" class="glyphicon glyphicon-log-out">Logout</a></li>';
          } else {
            echo '<li><a href="/webapp/includes/logout.inc.php"><span class="glyphicon glyphicon-sign-up"></span>Sign Up</a></li>';
            echo '<li><a href="/webapp/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          } 
        ?>
      </ul>

    </div>
  </nav>
</head>