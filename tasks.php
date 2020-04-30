<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();

if( isset($_SESSION["login"])){
    $action=  filter_input(INPUT_GET, 'action');
    if( $action=='false'){
        session_unset();
        session_destroy();
    }
}

else {
        header("Location: ../ToDo/index.php");
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
<style>
   .week{
     padding:2%;
     margin-top:20px;
     margin-bottom:60px;
     box-shadow:2px 4px 5px black;
     background-color:#fcf7f3;
 }
 </style>
</head>

<body id="0">
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
            <li class="nav-item d-block d-ml-none d-lg-none d-xl-none">
                <a class="nav-link text-danger" href="#">Logout</a>
            </li>
            
        </ul>
    </div>
    <div class="nav-item col-1 d-none d-ml-block d-lg-block d-xl-block" style="text-align: center;border: red 3px solid; border-radius:10px;">
        <a class=" text-danger" href="index.php?action=false"><b>Log Out</b></a>
    </div>
</nav>
    
<div class="container">
    <h1 class='mt-4'>Tasks</h1>

    <div class="week">
        <a href="#0" style="float:right;color:blue;">back to top</a>
        <h4 id="1">Monday May 4</h4>
        <p>5 Days Away</p>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" style="color:blue;" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1" style="color:grey;">
              Tasks go here with even more words than these but these can still be considered words once they are read in a certain light that is only found at the top of mountains in the region of the blue spruce that only grows on those mountains
            </label>
        </div>

    </div>
    
    
        
   
</div><!--/.container-->


</body>
</html>
