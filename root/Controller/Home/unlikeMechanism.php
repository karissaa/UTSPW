<?php
    if(isset($_GET['target'])){
        session_start();

        $postID = $_GET['target'];
        $userID = $_SESSION['user_id'];
        $destination = 'homeController.php';

        if($_GET['source'] == 'profile') $destination = '../Profile/profileController.php?target=timeline';

        try {
            include '../../Model/connection.php';

            $query = $db->prepare("DELETE FROM likes WHERE idPost = :postID AND idUser = :userID");
            $query->bindParam(':postID', $postID);
            $query->bindParam(':userID', $userID);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;
    header('Location: ' . $destination)
?>