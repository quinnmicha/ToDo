<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();

if( isset($_SESSION["login"])){
    $action=  filter_input(INPUT_GET, 'action');
    if( $action=='false'){
        session_unset();
        session_destroy();
    }
    
    else {
        header("Location: ../ToDo/tasks.php");
    }
}
else if(isPostRequest()){
    $user = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');
    $login = login($user, $pass);
    if($login!=false){
        
        $_SESSION['login'] = true;
        $_SESSION['username'] = $login[0]['username'];
        $_SESSION['userID'] = $login[0]['userID'];
        $_SESSION['taskIcon'] = $login[0]['taskIcon'];
        header("Location: ../ToDo/tasks.php");
    }
}


?>
<html lang="en">
<head>
  <title>My Planner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src='../ToDo/model/validation.js'></script>
  
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Planner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            
        </ul>
    </div>
    
</nav>
    
<div class="container">
    <form method='POST' class='m-auto w-50'>
        <h1 class='mt-4'>Login</h1>
        <?php
            if(isPostRequest())
            {
                echo 
                '<div>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Login Failed</strong> check your spelling
                    </div>
                </div>';
            } 
        ?>
        <div class="form-group mt-5">
            <input class='form-control' type="text" name="username" placeholder="Username">
        </div>
        <div class="form-group mt-2">
            <input class='form-control' type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group ml-5">
            <input type='submit' class="btn btn-outline-primary ml-5" value='Submit'>
        </div>
    </form>
    
    <h6 class='m-4'>Don't have an account? <a href="../ToDo/register.php">Create one here.</a></h6>
    
    
        
   
</div><!--/.container-->


</body>
</html>
