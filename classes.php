<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();



if( isset($_SESSION["login"])){
    $action=  filter_input(INPUT_GET, 'action');
    $delete = filter_input(INPUT_GET, 'delete');//classID
    if( $action=='false'){
        session_unset();
        session_destroy();
    }
    if( $action=='delete'){
        deleteClass($delete);
    }
    
    if(isPostRequest()){
        $action = filter_input(INPUT_POST, 'action');
        if($action == 'addClass'){
            $className = filter_input(INPUT_POST, 'className');
            $color = filter_input(INPUT_POST, 'color');
            addClass($_SESSION['userID'], $className, $color);
        }
        if($action == 'editClass'){
            $className = filter_input(INPUT_POST, 'className');
            $classID = filter_input(INPUT_POST, 'classID');
            $color = filter_input(INPUT_POST, 'color');
            editClass($classID, $className, $color);
        }
        
    }
    $classes = getClasses($_SESSION["userID"]);
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
<script src="https://kit.fontawesome.com/b462721291.js" crossorigin="anonymous"></script>
<style>
   .week{
     padding:2%;
     margin-top:20px;
     margin-bottom:60px;
     box-shadow:2px 4px 5px black;
 }
 </style>
 <script type="text/javascript" src="model/modal.js"></script>
</head>

<body id="0">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">My Planner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="nav-link text-success" onclick="addClass()">Add Class</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='classes.php'>Edit Classes</a>
            </li>
            <li class="nav-item d-block d-ml-none d-lg-none d-xl-none">
                <a class="nav-link text-danger" href="index.php?action=false">Logout</a>
            </li>
            
        </ul>
    </div>
    <div class="nav-item col-1 d-none d-ml-block d-lg-block d-xl-block" style="text-align: center;border: red 3px solid; border-radius:10px;">
        <a class=" text-danger" href="index.php?action=false"><b>Log Out</b></a>
    </div>
</nav>
    
<div class="container">
    <div id="top" class="row">
        <h1 class='mt-4 col-4' style="border:red 2px solid;">Classes</h1>
    </div>

    <div class="mt-4">
        <?php if($classes!=NULL){
            include __DIR__.'/model/viewClasses.php';
            }
            else{
                echo"<h4>No Classes Yet</h4><p>Go add some</p>";
            }
        ?>
    </div>





<script>
    
</script>
   
</div><!--/.container-->


</body>
</html>

