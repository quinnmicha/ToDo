<?php
include ('db.php');

global $db;

$noteID = filter_input(INPUT_POST, 'noteId');
$noteActive = filter_input(INPUT_POST, 'noteActive');
$x = 1;

$stmt = $db->prepare("UPDATE ToDo_Notes SET noteActive = :noteActive WHERE noteID = :noteID");

$binds=array(
    ":noteActive"=>$noteActive,
    ":noteID"=>$noteID
);

if($stmt->execute($binds)){
    $x = 2;
}
?>

