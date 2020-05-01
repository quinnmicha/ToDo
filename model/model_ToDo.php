<?php 
    include ('db.php');

    //Returns true if user is registered
    //else returns false
    function register($user, $pass){
        global $db;
        $pass=sha1($pass);
        
        $stmt= $db->prepare('INSERT INTO ToDo_Login (username, password) VALUES (:user, :pass);');
        
        $binds = array(
            ":user"=>$user,
            ":pass"=>$pass
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
        
    //Returns username if user exists and password matches
    //else returns false
    function login($user, $pass){
        global $db;
        
        $pass = sha1($pass);
        $stmt = $db->prepare("SELECT userID, username FROM ToDo_Login WHERE username = :user && password = :pass");   
        
        $binds = array(
            ":user"=>$user,
            ":pass"=>$pass
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
    
    function getTasksNew($userID){
        global $db;
        
        //can possibly add group by className to group class assignments together regardless of date
        $stmt = $db->prepare("SELECT className, color, noteDate, noteText, noteActive FROM ToDo_Notes AS Notes JOIN ToDo_Class As Class ON Notes.classID = Class.classID WHERE Class.userID = :userID AND Notes.noteActive = 0 ORDER BY noteDate ASC;");
        
        $binds = array(
            ":userID" => $userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
    
    function getTasksOld($userID){
        global $db;
        
        //can possibly add group by className to group class assignments together regardless of date
        $stmt = $db->prepare("SELECT className, color, noteDate, noteText, noteActive FROM ToDo_Notes AS Notes JOIN ToDo_Class As Class ON Notes.classID = Class.classID WHERE Class.userID = :userID AND Notes.noteActive = 1 ORDER BY noteDate ASC;");
        
        $binds = array(
            ":userID" => $userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
    
    function getClasses($userID){
        global $db;
        
        $stmt = $db->prepare("SELECT classID, className, color FROM ToDo_Class WHERE userID = :userID");
        
        $binds = array(
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
    
    function addClass($userID, $className, $color){
        global $db;
        
        $stmt= $db->prepare("INSERT INTO ToDo_Class (userID, className, color) VALUES (:userID, :className, :color)");
        
        $binds = array(
            ":userID"=>$userID,
            ":className"=>$className,
            ":color"=>$color
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    function addTask($classID, $noteDate, $noteText){
        global $db;
        
        echo $classID, $noteText;
        echo $noteDate;
        
        $stmt = $db->prepare("INSERT INTO ToDo_Notes (classID, noteDate, noteText, noteActive) VALUES (:classID, :noteDate, :noteText, 0)");
        
        $binds = array(
            ":classID"=>$classID,
            ":noteDate"=>$noteDate,
            "noteText"=>$noteText
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    function editClass(){}
    function deleteClass($classID){
        global $db;
        
        $stmt= $db->prepare("DELETE FROM ToDo_Class WHERE classID = :classID");
        
        $binds = array(
            "classID"=>$classID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    
    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
?>