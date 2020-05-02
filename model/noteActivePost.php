<?php
include ('db.php');

    $noteID = filter_input(INPUT_POST, 'noteIDJS');
    $noteActive = filter_input(INPUT_POST, 'noteActiveJS');

    $stmt = $db->prepare("UPDATE ToDo_Notes SET noteActive = ".$noteActive." WHERE noteID = ".$noteID.";");
    //Not the way I wanted to do it, but hopefully still ok

    if($stmt->execute() && $stmt->rowCount()>0){
        echo 'worked';
    }
    else{
        echo 'failed';
    }
?>

