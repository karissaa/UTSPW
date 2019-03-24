<?php
    $destination = 'loginController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $displayName     = strip_tags(htmlspecialchars($_POST['userDisplayName']));
        $uname           = strip_tags(htmlspecialchars($_POST['userName']));
        $gender          = strip_tags(htmlspecialchars($_POST['gender']));
        $passwd          = strip_tags(htmlspecialchars($_POST['userPassword']));
        $confirmPassword = strip_tags(htmlspecialchars($_POST['userPasswordConfirm']));
        $birthday        = strip_tags(htmlspecialchars($_POST['userBirthday']));
        $email           = strip_tags(htmlspecialchars($_POST['userEmail']));
        $currDate        = date('Y-m-d H:i:s');

        if($passwd === $confirmPassword){
            session_start();

            $_SESSION['failed'] = 'signup';

            try {
                include '../../Model/connection.php';
    
                $query = $db->prepare("INSERT INTO user (username, password, dispName, gender, birthDate, email, dateRegistered, bio, phoneNum, profPic) VALUES (:username, :password, :displayName, :gender, :birthdate, :email, :currTime, null, '', null)");

                $query->bindParam(':username', $uname);
                $query->bindParam(':password', $passwd);
                $query->bindParam(':displayName', $displayName);
                $query->bindParam(':gender', $gender);
                $query->bindParam(':birthdate', $birthday);
                $query->bindParam(':email', $email);
                $query->bindParam(':currTime', $currDate);

                if($query->execute()) $_SESSION['failed'] = 'false';
            } catch (PDOException $e) {
                echo 'Database Error : ' . $e->getMessage();
            }
        }
    }
    $query = null;
    $db = null;    

    header('Location: ' . $destination);
?>