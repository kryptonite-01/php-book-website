<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Bootstrap 5 icons  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <title>Website Admin</title>
</head>

<body>

  <?php $url = "http://".$_SERVER['HTTP_HOST']."/php-projects/book-website";  ?>

  <nav class="nav justify-content-center  ">
    <a class="nav-link active" href="#" aria-current="page">Admin</a>
    <a class="nav-link" href="<?php echo $url; ?>/admin/home.php">Home</a>
    <a class="nav-link" href="<?php echo $url; ?>/admin/sections/books.php">Books</a>
    <a class="nav-link" href="<?php echo $url; ?>/admin/sections/logout.php">Log Out</a>
    <a class="nav-link" href="<?php echo $url;?>">Website</a>
  </nav>
    <div class="container">
        <div class="row">
          