<?php

include __DIR__ . '/Model/model_ToDo.php';

session_start();



if( isset($_SESSION["login"])){
    $action=  filter_input(INPUT_GET, 'action');
    if( $action=='false'){
        session_unset();
        session_destroy();
    }
    if($action=='delete'){
            $noteID = filter_input(INPUT_GET, 'delete');
            deleteTask($noteID);
            header("Location: ../ToDo/tasks.php");
        }
    
    if(isPostRequest()){
        $action = filter_input(INPUT_POST, 'action');
        if($action == 'addClass'){
            $className = filter_input(INPUT_POST, 'className');
            $color = filter_input(INPUT_POST, 'color');
            addClass($_SESSION['userID'], $className, $color);
        }
        if($action == 'addTask'){
            $classID = filter_input(INPUT_POST, 'class');
            $noteDate = filter_input(INPUT_POST, 'date');
            $noteText = filter_input(INPUT_POST, 'task');
            addTask($classID, $noteDate, $noteText);
            header("Location: ../ToDo/tasks.php");//To fix the bug where it will create multiple copies if you check the task off right after making it
        }
        if($action == 'active'){
            
        }
        
    }
    $classes = getClasses($_SESSION["userID"]);
    $taskDataNew = getTasksNew($_SESSION["userID"]);
    $taskDataOld = getTasksOld($_SESSION["userID"]);
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

</head>

<body id="0">
 <?php include __DIR__.'/model/navbar.php'; ?>
    
<div class="container">
    <div id="top" class="row">
        <h1 class='mt-4 col-4'>Tasks</h1>
        <span class="offset-5 d-inline-block mt-4" style="color:<?php echo $_SESSION['taskColor'];?>;font-size:3em;">
            <i class="<?php echo $_SESSION['taskIcon']?>" onclick="addTask()"></i>
            <p style="font-size:16px; margin:0;padding:0;">Add Task</p>
        </span>
    </div>

    <?php if($taskDataNew!=NULL){
        include __DIR__.'/model/tasksNew.php';
    }?>
    
    
    
    <?php if($taskDataOld!=NULL){
        include __DIR__.'/model/tasksOld.php';
    }?>
    
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

    <div id="addTask" class="modal">

        <div class="modal-content mt-4">
            <div>
                <span class="close">&times;</span>
            </div>
            <form action="../ToDo/tasks.php" method="post">
                <div class="modal-body container-fluid">
                    <div class="form-group">
                        <input type="hidden" name="action" value ="addTask">
                        <label for="class">Class:</label>
                        <select class="form-control" id="class" name='class'>
                            <?php foreach ($classes AS $class): ?>
                          <option value='<?php echo $class['classID']; ?>'><?php echo $class['className'];?></option>
                          <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <label class="control-label" for="date">Date and Time Due:(24 Hour clock)</label>
                            <input type="datetime-local" class="form-control" style="border-color: #5380b7;" id="date" name="date" >
                            <div class="invalid-feedback">Please enter the date and time it is due.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <label class="control-label" for="task">Task:</label>
                            <textarea class="form-control" style="border-color: #5380b7;" id="task" name="task" ></textarea>
                            <div class="invalid-feedback">Please don't leave empty</div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" onclick='return addTaskCheck()'  value="Add Item" id="submitAdd">
                </div>
            </form>
        </div>

    </div>

<script type='text/javascript' src='model/activePost.js'></script>
   
</div><!--/.container-->

 <script type="text/javascript" src="model/modal.js"></script>
</body>
</html>
