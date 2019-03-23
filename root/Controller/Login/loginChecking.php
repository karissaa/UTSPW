<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST["email"];
        $pass = $_POST["password"];

        //Input sanitazion, di-escape, baru di strip
        $u_name = strip_tags(htmlspecialchars($email));
        $passwd = strip_tags(htmlspecialchars($pass));

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

                    
                    $_SESSION['active_user']; //Session Variabel ini rencananya akan menampung objek User

                    //Set Destination
                    $destination = '../Home/homeController.php';
                    $fail = false;
                } 
            }

            if($fail) {
                unset($_SESSION['user_id']);
                session_destroy();

                $destination = 'loginController.php?failed_login';
            }

            //Free resource
            $result = null;
            $query = null;
            $db = null;
            
            echo $destination;

            header("Location: " . $destination);
            die();
        } catch (PDOException $e) {
            $result = null;
            $query = null;
            $db = null;
            echo "Database Error : " . $e.getMessage();
        }
    }
?>