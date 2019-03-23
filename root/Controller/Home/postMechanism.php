<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        $text = strip_tags(htmlspecialchars($_POST['postText']));

        $datePost = date('Y-m-d H:i:s');
        $idUser = $_SESSION['user_id'];

        //Untuk sementara, jangan post gambar dulu. Belum diimplement
        $type;
        if(isset($_FILE['graphicFile'])) $type = img;
        else $type = 'txt';

        $imgDirectory = null;
        $destination = 'homeController.php';

        try {
            include '../../Model/connection.php';

            $query = $db->prepare("INSERT INTO post (type, text, datePost, idUser, imgDirectory) VALUE (:type, :text, :datePost, :userID, :imgDir)");
            $query->bindParam(':type', $type);
            $query->bindParam(':text', $text);
            $query->bindParam(':datePost', $datePost);
            $query->bindParam(':userID', $idUser);
            $query->bindParam(':imgDir', $imgDirectory);

            if($query->execute()) $destination .= '?post_success';
            else $destination .= '?post_failed';
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }

        echo $destination;

        $query = null;
        $db = null; 
        header('Location: ' . $destination);
    }
?>