<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        $text = strip_tags(htmlspecialchars($_POST['postText']));

        $datePost = date('Y-m-d H.i.s');
        $idUser = $_SESSION['user_id'];
        $targetPath = '';
        $type = 'txt';    
        $uploadOk = true;

        $_SESSION['post'] = false;

        if($_FILES['graphicFile']['error'] == 0){
            $targetPath= '../../Images/User/' . $_SESSION['user_id'] . '/' . $datePost;

            if(!is_dir($targetPath)){
                $oldUmask = umask(0);
                mkdir($targetPath, 0777, true);
                umask($oldUmask);
            }

            $targetPath .= '/' . basename($_FILES['graphicFile']['name']);
            
            $imageFileType = strtolower(pathinfo($targetPath,PATHINFO_EXTENSION));

            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"){
                $type = "img";
                $uploadOk = move_uploaded_file($_FILES['graphicFile']["tmp_name"], $targetPath);
                $uploadOk = true;            
            }
            else{
                $targetPath = '';
                $uploadOk = false;
            }
        }

        $imgDirectory = $targetPath;
        $destination = 'homeController.php';
        
        if($uploadOk){
            try {
                include '../../Model/connection.php';
    
                $query = $db->prepare("INSERT INTO post (type, text, datePost, idUser, imgDirectory) VALUE (:type, :text, :datePost, :userID, :imgDir)");
                $query->bindParam(':type', $type);
                $query->bindParam(':text', $text);
                $query->bindParam(':datePost', $datePost);
                $query->bindParam(':userID', $idUser);
                $query->bindParam(':imgDir', $imgDirectory);
    
                if($query->execute())
                    $_SESSION['post'] = true;
                
            } catch (PDOException $e) {
                echo 'Database Error : ' . $e->getMessage();
            }
        }
    }

    $query = null;
    $db = null; 
    header('Location: ' . $destination);
?>