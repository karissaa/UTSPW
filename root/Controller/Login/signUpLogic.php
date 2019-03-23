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

                if($query->execute()) $destination .= '?ok_signup';
                else $destination .= '?failed_signup';
                
                $query = null;
                $db = null;                    
    
            } catch (PDOException $e) {
                $query = null;
                $db = null;
                echo 'Database Error : ' . $e->getMessage();
                $destination .= '?failed_signup';
            }
        }

        echo $displayName . "\n";
        echo $uname . "\n";
        echo $passwd . "\n";
        echo $gender . "\n";
        echo $birthday . "\n";
        echo $email . "\n";
        echo date('Y-m-d H:i:s') . "\n";
    }

    header('Location: ' . $destination);
?>