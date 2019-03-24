<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();

        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['postID'];
        $commentText = $_POST['commentText'];
        $dateComment = date('Y-m-d h:i:s');
        $destination = 'homeController.php';

        //By default false
        $_SESSION['comment'] = false;

        try {
            include '../../Model/connection.php';

            $query = $db->prepare("INSERT INTO comment (idPost, idUser, text, dateComment) VALUE (:postID, :userID, :commentText, :dateComment)");
            $query->bindParam(':userID', $user_id);
            $query->bindParam(':postID', $post_id);
            $query->bindParam(':commentText', $commentText);
            $query->bindParam(':dateComment', $dateComment);

            if($query->execute()) $_SESSION['comment'] = true;
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;

    header('Location: ' . $destination);
?>