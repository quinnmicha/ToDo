<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();

if(isset($_SESSION["login"])){
    //header('Location: ../Recipe/addRecipe.php');
}

if(isPostRequest()){
    $user = FILTER_INPUT(INPUT_POST, 'username');
    $pass = FILTER_INPUT(INPUT_POST, 'password');
    //echo $userType;
    if(register($user, $pass)){
        header('Location: ../ToDo/index.php');
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
</nav>
    
<div class="container" style="min-height:690px;">
    <form method='POST' class='m-auto w-50'>
        <h1 class='mt-4'>Register</h1>
        <div class="form-group mt-5">
            <input class='form-control' type="text" name="username" id='username' placeholder="Username">
        </div>
        <div class="form-group mt-2">
            <input class='form-control' type="text" name="password" id='password' placeholder="Password">
        </div>
        <div class="form-group mt-2">
            <input class='form-control' type="text" name="confPassword" id='confPassword' placeholder="Confirm Password">
            <div class="invalid-feedback">
                Password and Confirm Password must match.
            </div>
        </div>
        <div class="form-group ml-5">
            <button type='submit' class="btn btn-outline-primary ml-5" onclick='return checkData()'>Submit</button>
        </div>
    </form>
    
    <h6 class='m-4'>Have an account? <a href="../ToDo/index.php">Login here.</a></h6>
    
    
        
   
</div><!--/.container-->
<?php include __DIR__.'/model/footer.php'; ?>

</body>
</html>
