<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        
        $email = $_POST["email"];
        $pass = $_POST["password"];

        //Input sanitazion, di-escape, baru di strip
        $u_name = strip_tags(htmlspecialchars($email));
        $passwd = strip_tags(htmlspecialchars($pass));

        $destination = 'loginController.php';
        $_SESSION['failed'] = 'login';
        unset($_SESSION['user_id']);

        try {
            include "../../Model/connection.php";

            $destination;
            $fail = true;

            $query = $db->prepare("SELECT * FROM user WHERE email = :email");
            $query->bindParam(':email', $u_name, PDO::PARAM_STR);

            if($query->execute()){
                session_start();
                $result = $query->fetch();

                if($result['password'] == $passwd){ //Kalau login sukses             
                    //Session variable user_id di set di sini untuk digunakan di tempat-tempat lainnya
                    $_SESSION['user_id'] = $result['idUser'];
                    unset($_SESSION['failed']);

                    //Set Destination
                    $destination = '../Home/homeController.php';
                } 
            }
        } catch (PDOException $e) {
            echo "Database Error : " . $e->getMessage();
        }
    }
    //Free resource
    $result = null;
    $query = null;
    $db = null;

    header("Location: " . $destination);
?>