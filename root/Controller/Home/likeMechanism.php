<?php
    if(isset($_GET['target'])){
        session_start();

        $_SESSION['like'] = false;
        $postID = $_GET['target'];
        $userID = $_SESSION['user_id'];
        $dateLike = date('Y-m-d h:i:s');

        try {
            include '../../Model/connection.php';

            $query = $db->prepare("INSERT INTO likes (idPost, idUser, dateLikes) VALUE (:postID, :userID, :dateLikes)");
            $query->bindParam(':postID', $postID);
            $query->bindParam(':userID', $userID);
            $query->bindParam(':dateLikes', $dateLike);

            if($query->execute()) $_SESSION['like'] = true;

        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;
    header('Location: homeController.php');
?>