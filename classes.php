<?php

include __DIR__ . '/model/model_ToDo.php';

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
 <?php include __DIR__.'/model/navbar.php'; ?>
    
<div class="container" style="min-height:690px;">
    <div id="top" class="row">
        <h1 class='mt-4 col-4'>Classes</h1>
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

<!--   ~~~~~~~~~MODALS~~~~~~~~~~       -->
    
    <div id="addClass" class="modal">

        <div class="modal-content mt-4">
            <div>
                <span class="close">&times;</span>
            </div>
            <form action="../ToDo/classes.php" method="post">
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
                    <input type="submit" class="btn btn-success" onclick="return addClassCheck()" value="Add Item" id="submitAdd">
                    <script type="text/javascript" src='../ToDo/model/validation.js'></script>
                </div>
            </form>
        </div>

    </div>



<script type='text/javascript' src='model/activePost.js'></script>
   
</div><!--/.container-->
<?php include __DIR__.'/model/footer.php'; ?>

</body>
</html>

