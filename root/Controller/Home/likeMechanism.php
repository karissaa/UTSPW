<?php
    if(isset($_GET['target'])){
        session_start();

        if(!isset($_SESSION['user_id'])) header('Location: ../Login/loginController.php');


        $postID = $_GET['target'];
        $userID = $_SESSION['user_id'];
        $dateLike = date('Y-m-d h:i:s');
        $destination = 'homeController.php';

        if($_GET['source'] == 'profile') $destination = '../Profile/profileController.php?target=timeline';

        try {
            include '../../Model/connection.php';

            $query = $db->prepare("INSERT INTO likes (idPost, idUser, dateLikes) VALUE (:postID, :userID, :dateLikes)");
            $query->bindParam(':postID', $postID);
            $query->bindParam(':userID', $userID);
            $query->bindParam(':dateLikes', $dateLike);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;
    header('Location: ' . $destination);
?>