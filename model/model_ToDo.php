<?php 
    include ('db.php');

    //Returns true if user is registered
    //else returns false
    function register($user, $pass){
        global $db;
        
        $Users= array();                        //
        $Users = getUserNames();                // Checks if the username supplied is already registered
        foreach($Users as $u){                  // If it is then the function fails
            if(in_array($user, $u, true)){      //
                                                //
            return 0;                           //
            }
        }
        
        $newPass=sha1($pass);
        
        $stmt= $db->prepare("INSERT INTO `ToDo_Login` (username, `password`, taskIcon, taskColor) VALUES (:user, :pass, 'fad fa-space-station-moon-alt', '#5cb85c');");//hard codes deathstar as first icon
        
        $binds = array(
            ":user"=>$user,
            ":pass"=>$newPass
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
   
    
        //Used to validate registration
    // so that no two accounts can have the same username
    function getUserNames(){
        global $db;
        
        $stmt=$db->prepare("SELECT username FROM ToDo_Login");
        
        if($stmt->execute() && $stmt->rowCount()>0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($results);
        }
        else{
            return false;
        }
    }
        
    //Returns username if user exists and password matches
    //else returns false
    function login($user, $pass){
        global $db;
        
        $newPass = sha1($pass);
        $stmt = $db->prepare("SELECT userID, username, taskColor, taskIcon FROM ToDo_Login WHERE username = :user && password = :pass");   
        
        $binds = array(
            ":user"=>$user,
            ":pass"=>$newPass
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
    
        //Returns true if user is registered
    //else returns false
    function changeUsername($userID, $user){
        global $db;
        
        $Users= array();                        //
        $Users = getUserNames();                // Checks if the username supplied is already registered
        foreach($Users as $u){                  // If it is then the function fails
            if(in_array($user, $u, true)){      //
                                                //
            return 0;                           //
            }
        }
        
        $stmt= $db->prepare("UPDATE ToDo_Login SET username = :user WHERE userID = :userID;");
        
        $binds = array(
            ":user"=>$user,
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
    
    //Returns true if user is registered
    //else returns false
    function changePassword($userID, $pass){
        global $db;
        $newPass=sha1($pass);
        
        $stmt= $db->prepare("UPDATE ToDo_Login SET password = :pass WHERE userID = :userID;");
        
        $binds = array(
            ":pass"=>$newPass,
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
    
    function changeIcon($userID, $icon){
        global $db;
        
        $stmt = $db->prepare("UPDATE ToDo_Login SET taskIcon = :icon WHERE userID = :userID");
        
        $binds = array(
            ":icon"=>$icon,
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    function changeTaskColor($userID, $color){
        global $db;
        
        $stmt = $db->prepare("UPDATE ToDo_Login SET taskColor = :color WHERE userID = :userID");
        
        $binds = array(
            ":color"=>$color,
            ":userID"=>$userID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    function getTasksNew($userID){
        global $db;
        
        //can possibly add group by className to group class assignments together regardless of date
        $stmt = $db->prepare("SELECT noteID, className, color, noteDate, noteText, noteActive FROM ToDo_Notes AS Notes JOIN ToDo_Class As Class ON Notes.classID = Class.classID WHERE Class.userID = :userID AND Notes.noteActive = 0 ORDER BY noteDate ASC;");
        
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
        $stmt = $db->prepare("SELECT noteID, className, color, noteDate, noteText, noteActive FROM ToDo_Notes AS Notes JOIN ToDo_Class As Class ON Notes.classID = Class.classID WHERE Class.userID = :userID AND Notes.noteActive = 1 ORDER BY noteDate ASC;");
        
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
    
    function editClass($classID, $className, $color){
        global $db;
        
        $stmt = $db->prepare("UPDATE ToDo_Class SET className = :className, color = :color WHERE classID = :classID");
        
        $binds = array (
            ":className"=>$className,
            ":color"=>$color,
            ":classID"=>$classID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
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
    
    function deleteTask($noteID){
        global $db;
        
        $stmt= $db->prepare("DELETE FROM ToDo_Notes WHERE noteID = :noteID");
        
        $binds = array(
            "noteID"=>$noteID
        );
        
        if($stmt->execute($binds) && $stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    
    //function to display icons that can be used
    function getIcons(){
        $icons = array(
            //the name is arbitrary and more for me
            //these are fontAwesome icons
            array("name"=>"deathStar","value" => "fad fa-space-station-moon-alt"),
            array("name"=>"space-station-moon","value" => "fas fa-space-station-moon"),
            array("name"=>"jediOrder","value" => "fab fa-jedi-order"),
            array("name"=>"galacticRepublic","value" => "fab fa-galactic-republic"),
            array("name"=>"starFighterAlt","value" => "fas fa-starfighter-alt"),
            array("name"=>"starFighter","value" => "fas fa-starfighter"),
            array("name"=>"starshipFreighter","value" => "fas fa-starship-freighter"),
            array("name"=>"narwhal","value" => "fad fa-narwhal"),
            array("name"=>"wine-glass-alt","value" => "fas fa-wine-glass-alt")
            
        );
        return $icons;
    }
    
    
    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
?>