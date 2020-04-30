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
    
    
?>