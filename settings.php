<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();



if( isset($_SESSION["login"])){
    $action=  filter_input(INPUT_GET, 'action');
    if( $action=='false'){
        session_unset();
        session_destroy();
    }
    
    
    if(isPostRequest()){
        $action = filter_input(INPUT_POST, 'action');
        if($action=='changeUser'){
            $newUser = filter_input(INPUT_Post, 'newUsername');
            changeUsername($_SESSION['userID'], $newUsername);
            header("Location: ../ToDo/settings.php");
        }
        if($action=='changePass'){
            $newPass = filter_input(INPUT_POST, 'newPass');
            changePassword($_SESSION['userID'], $newPassword);
            header("Location: ../ToDo/settings.php");
        }
        if($action=='changeIcon'){
            $icon = filter_input(INPUT_POST, 'icon');
            $_SESSION['taskIcon']=$icon;
            changeIcon($_SESSION['userID'], $icon);
        }
        
    }
    $icons = getIcons();
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
                <span class="nav-link text-success" onclick="addClass()"><i class="far fa-plus"></i> Add Class</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='classes.php'><i class="far fa-tasks-alt"></i> Edit Classes</a>
            </li>
            <li>
                <a class="nav-link" href='classes.php'><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item d-block d-ml-none d-lg-none d-xl-none">
                <a class="nav-link text-danger" href="index.php?action=false"><i class="fas fa-sign-out"></i> Logout</a>
            </li>
            
            
        </ul>
    </div>
    <div class="nav-item col-1 d-none d-ml-block d-lg-block d-xl-block" style="text-align: center;border: red 3px solid; border-radius:10px;">
        <a class=" text-danger" href="index.php?action=false"><b>Log Out</b></a>
    </div>
</nav>
<!--~~~~~~~~~~~~~~~~~/nav~~~~~~~~~~~~~~~~~~~~~~~~~~~~ --> 
<div class="container">
    <div id="top" class="row">
        <h1 class='mt-4 col-4'>Settings</h1>
        <h4 class="mt-2 col-12"><?php echo $_SESSION['username'];?></h4>
        
    </div>
    <div class="col">
        <button class="btn btn-info col-5 mt-2" id="changeIcon">Change Task Icon</button>
        <button class="btn btn-info col-5 mt-2" id="changeTaskColor">Change Task Color</button>
    </div>
    <div class="col mt-4">
        <button class="btn btn-info col-5  mt-4" id="changeUser">Change Username</button>
        <button class="btn btn-info col-5 mt-4" id="changePass">Change Password</button>
    </div>
    
    <form action="settings.php" id="changeTaskColorForm" class="col-8 offset-2 mt-4 d-none" method="POST">
        <input type="hidden" value="changeTaskColor" name="action">
        <div class="form-row">
            <input type="color" class="form-control" value="#5cb85c" name="newTaskColor">
        </div>
        <div class="form-row">
            <input type="submit" class="btn btn-success col-8 offset-4 mt-2" value="Change Color">
        </div>
        
    </form>
    
    <form action="settings.php" id="changeUserForm" class="col-8 offset-2 mt-4 d-none" method="POST">
        <input type="hidden" value="changeUser" name="action">
        <div class="form-row">
            <input type="text" class="form-control" placeholder="New Username" name="newUsername">
        </div>
        <div class="form-row">
            <input type="submit" class="btn btn-success col-8 offset-4 mt-2" value="Change Username">
        </div>
        
    </form>
    
    <form action="settings.php" id="changePassForm" class="col-8 offset-2 mt-4 d-none" method="POST">
        <input type="hidden" value="changePass" name="action">
        <div class="form-row">
            <input type="text" class="form-control mb-2" placeholder="New Password" name="newPassword" id="password">
        </div>
        <div class="form-row">
            <input type="text" class="form-control" placeholder="Confirm New Password" id="confPassword">
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-success col-8 offset-4 mt-2" onclick="return changePasswordCheck()">Change Password</button>
        </div>
        
    </form>
    
    <form action="settings.php" id="taskIconForm"  class="mt-4 d-none" method="POST">
        <input type="hidden" value="changeIcon" name="action">
        <input type="submit" class="btn btn-success mb-2" value="Confirm Icon">
        <?php foreach($icons AS $icon): ?>
        <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="icon" id="<?php echo $icon["name"];?>" value="<?php echo $icon["value"];?>" checked>
            <label class="form-check-label" for="<?php echo $icon["name"];?>">
                <span class="d-inline-block text-success" style="font-size:3em;">
                    <i class="<?php echo $icon["value"];?>" onclick=""></i>
                </span>
            </label>
        </div>
        <?php endforeach; ?>
</div>
    </form>
          
    
    
<!--   ~~~~~~~~~MODALS~~~~~~~~~~       -->
    
    <div id="addClass" class="modal">

        <div class="modal-content mt-4">
            <div>
                <span class="close">&times;</span>
            </div>
            <form action="../ToDo/tasks.php" method="post">
                <div class="modal-body container-fluid">
                    <div class="form-group">
                        <div class="form-row">
                            <input type="hidden" name="action" value ="addClass">
                            <label class="control-label" for="className">class Name:</label>
                            <input type="text" class="form-control" style="border-color: #5380b7;" id="className" placeholder="Enter Item Name" name="className" >
                            <div class="invalid-feedback">Please type your User Name.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <label class="control-label" for="color">Color (stay light):</label>
                            <input type="color" class="form-control" style="border-color: #5380b7;" id="color" name="color" >
                            <div class="invalid-feedback">Please enter a unit price. Only use numbers and one decimal point</div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success"  value="Add Item" id="submitAdd">
                </div>
            </form>
        </div>

    </div>

<script type='text/javascript' src='model/activePost.js'></script>
<script type='text/javascript' src='model/settings.js'></script>
   
</div><!--/.container-->


</body>
</html>
