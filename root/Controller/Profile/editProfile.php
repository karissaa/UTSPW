<?
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        $userId = $_SESSION['user_id'];
        $displayName = strip_tags(htmlspecialchars($_PUST['userDisplayName']));
        $gender = strip_tags(htmlspecialchars($_POST['gender']));
        $birthDate = strip_tags(htmlspecialchars($_POST['userBirthdate']));
        $phoneNumber = strip_tags(htmlspecialchars($_POST['userPhoneNumber']));
        $bio = strip_tags(htmlspecialchars($_POST['userBio']));

        try {
            $_SESSION['profile_edit'] = false;

            include '../../Model/connection.php';

            if(isset($userId) && !empty($userId) && isset($displayName) && !empty($displayName) && isset($gender) && !empty($gender) && isset($birthDate) && !empty($birthDate) && isset($bio) && isset($phoneNumber) && !empty($phoneNumber)){
                $query = $db->prepare("UPDATE user SET dispName = :dispName, gender = :gender, birthDate = :birthDate, phoneNum = :phoneNum, bio = :bio WHERE idUser = :userID");
                $query->bindParam(':dispName',$displayName);
                $query->bindParam(':gender',$gender);
                $query->bindParam(':birthDate',$birthDate);
                $query->bindParam(':phoneNum',$phoneNumber);
                $query->bindParam(':bio',$bio);
                $query->bindParam(':userID',$userId);

                if($query->execute()) $_SESSION['profile_edit'] = true;
            }
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    $query = null;
    $db = null;
    header('Location : profileController.php?target=about');
?>