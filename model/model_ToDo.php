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
    
    function getTasks($userID){
        global $db;
        
        //can possibly add group by className to group class assignments together regardless of date
        $stmt = $db->prepare("SELECT className, color, noteDate, noteText, noteActive FROM ToDo_Notes AS Notes JOIN ToDo_Class As Class ON Notes.classID = Class.classID WHERE Class.userID = :userID ORDER BY noteDate ASC;");
        
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
        
        $stmt = $db->prepare("SELECT className, color FROM ToDo_Class WHERE userID = :userID");
        
        $binds = array(
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt-rowCount()>0){
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
    
    
    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
?>