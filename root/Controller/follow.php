<?php
    session_start();
    $dateNow = date('Y-m-d h:i:s'); 
    $destination = './Profile/profileController.php?target=following';

    if(isset($_GET['follow'])){
        try{
            $_SESSION['follow'] = false;
            include '../Model/connection.php';

            $query = $db->prepare("INSERT INTO relationship (idFollowed, idFollower, dateFollow) VALUE (:idOther, :idSelf, :dateNow)");
    
            $query->bindParam(':idOther', $_GET['follow']);
            $query->bindParam(':idSelf', $_SESSION['user_id']);
            $query->bindParam(':dateNow', $dateNow);
    
            if($query->execute()){
                $_SESSION['follow'] = true;
            }
        } catch (PDOException $e){
            echo 'Database Error : ' . $e->getMessage();
        }
    }
    else if(isset($_GET['unfollow'])){
        try {
            $_SESSION['unfollow'] = false;

            include '../Model/connection.php';

            $query = $db->prepare("DELETE FROM relationship WHERE idFollower = :idSelf AND idFollowed = :idOther");
            $query->bindParam(':idOther', $_GET['unfollow']);
            $query->bindParam(':idSelf', $_SESSION['user_id']);

            if($query->execute()){
                $_SESSION['unfollow'] = true;
            }
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;
    header('Location: ' . $destination);
?>