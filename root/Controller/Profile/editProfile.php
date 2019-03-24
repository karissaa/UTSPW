<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();

        if(!isset($_SESSION['user_id'])) header('Location: ../Login/loginController.php');

        $userId = $_SESSION['user_id'];
        $displayName = strip_tags(htmlspecialchars($_POST['userDisplayName']));
        $gender = strip_tags(htmlspecialchars($_POST['gender']));
        $birthDate = strip_tags(htmlspecialchars($_POST['userBirthdate']));
        $phoneNumber = strip_tags(htmlspecialchars($_POST['userPhoneNumber']));
        $bio = strip_tags(htmlspecialchars($_POST['userBio']));

        $_SESSION['profile_edit'] = false;
        $targetPath = '';
        $uploadOk = true;

        if($_FILES['profilePicture']['error'] == 0){
            $targetPath= '../../Images/User/' . $_SESSION['user_id'] . '/Profile';

            if(!is_dir($targetPath)){
                $oldUmask = umask(0);
                mkdir($targetPath, 0755, true);
                umask($oldUmask);
            }

            $targetPath .= '/' . basename($_FILES['profilePicture']['name']);
            
            $imageFileType = strtolower(pathinfo($targetPath,PATHINFO_EXTENSION));

            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"){
                $type = "img";
                $uploadOk = move_uploaded_file($_FILES['profilePicture']["tmp_name"], $targetPath);
                $uploadOk = true;            
            }
            else{
                $targetPath = '';
                $uploadOk = false;
            }
        }

        $imgDirectory = $targetPath;

        if($uploadOk){
            try {
                include '../../Model/connection.php';            
                
                $query = $db->prepare("UPDATE user SET dispName = :dispName, gender = :gender, birthDate = :birthDate, phoneNum = :phoneNum, bio = :bio, profPic = :profPic WHERE idUser = :userID");
                $query->bindParam(':dispName',$displayName);
                $query->bindParam(':gender',$gender);   
                $query->bindParam(':birthDate',$birthDate);
                $query->bindParam(':phoneNum',$phoneNumber);
                $query->bindParam(':bio',$bio);
                $query->bindParam(':userID',$userId);
                $query->bindParam(':profPic', $imgDirectory);

                if($query->execute()) $_SESSION['profile_edit'] = true;
            } catch (PDOException $e) {
                echo 'Database Error : ' . $e->getMessage();
            }
        }
    }

    $query = null;
    $db = null;
    header('Location: profileController.php?target=about');
?>