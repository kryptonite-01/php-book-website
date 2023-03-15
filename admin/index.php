<?php 
session_start();
if($_POST){
  if(($_POST['user']=="kryptonite") && ($_POST['password']=="12345")){
    $_SESSION['user']='ok';
    $_SESSION['userName']='kryptonite';
    header('location:home.php');
  }else{
    $message="User or password incorrect.";
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
  <!-- Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-md-4"></div>
        <div class="col-md-4"><br><br>
            <div class="card">
              <div class="card-header"><h4 class="card-title">Login</h4></div>
                <div class="card-body">
                    <form method="post">
                        <div class = "form-group">
                            <label for="user">User</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Enter user">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="Sign In">
                    </form>
                </div>
            </div>
            <br/>
            <?php if(isset($message)){ ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>
        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>