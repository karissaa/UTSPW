<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try {
            include '../../Model/connection.php';
            $keyword = '%' .  $_POST['keyword'] . '%';
    
            $userQuery = $db->prepare("SELECT idUser, dispName, gender, birthDate, email, dateRegistered, bio, phoneNum, profPic FROM user WHERE dispName LIKE :keyword");
            $userQuery->bindParam(':keyword',$keyword);
    
            if($userQuery->execute()){
                
                include '../../Model/User.php';
                $userList = $userQuery->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $searchResult;

                $placeholderImage = '../../Images/User/avatar.png';
    
                //Susun supaya IDUser menjadi index dari objectnya di associative array
                foreach($userList as $user){
                    //basically, group User Object by UserIDs
                    $searchResult[$user->getIDUser()] = $user;
                }

                $followedQuery = $db->prepare("SELECT idFollowed FROM relationship WHERE idFollower = :userID");
                $followedQuery->bindParam(':userID', $_SESSION['user_id']);

                if($followedQuery->execute()){
                    $followings = $followedQuery->fetchAll(PDO::FETCH_ASSOC);
                
                    include '../../View/Search/searchView.php';                
                }
    
            }
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }
?>