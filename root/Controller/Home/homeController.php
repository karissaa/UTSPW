<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        try {
            session_start();
            include "../../Model/connection.php";

            //Ambil data-data user untuk ditampilkan (profile pic, nama, dll)
            //Query yang dicomment cuma akan ambil ID dari user-user friend, tetapi nanti error di comment
            //$queryUsers = $db->prepare("SELECT idUser, dispName, gender, birthDate, email, dateRegistered, bio, phoneNum, profPic FROM user WHERE idUser IN (SELECT :userID UNION SELECT idFollower FROM relationship WHERE idFollowed = :userID)");
            $queryUsers = $db->prepare("SELECT idUser, dispName, gender, birthDate, email, dateRegistered, bio, phoneNum, profPic FROM user");            

            if($queryUsers->execute()){
                include '../../Model/User.php';
                $userList = $queryUsers->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $userArr;

                //Susun supaya IDUser menjadi index dari objectnya di associative array
                foreach($userList as $user){
                    //basically, group User Object by UserIDs
                    $userArr[$user->getIDUser()] = $user;
                }                
                
                //Ambil post-post dari user yang login dan teman-temannya (1 degree)
                $queryPost = $db->prepare("SELECT * FROM post WHERE idUser IN (SELECT :userID UNION SELECT idFollowed FROM relationship WHERE idFollower = :userID) ORDER BY datePost DESC");
                $queryPost->bindParam(':userID', $_SESSION['user_id']);

                if($queryPost->execute()){
                    //Instantiate Post Object
                    include '../../Model/Post.php';

                    //Iterate rows of query result and parse to array of Post Object
                    $userPosts = $queryPost->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                    $placeholderImage = '../../Images/User/avatar.png';

                    $queryComments = $db->prepare("SELECT * FROM comment WHERE idPost IN (SELECT idPost FROM post WHERE idUser IN (SELECT :userID UNION SELECT idFollower FROM relationship WHERE idFollowed = :userID)) ORDER BY idPost, dateComment ASC");
                    $queryComments->bindParam(':userID', $_SESSION['user_id']);

                    if($queryComments->execute()){
                        include '../../Model/Comment.php';

                        $comments = $queryComments->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');                    
                        $commentArr;

                        //Basically ini group Comment Objects by PostID
                        foreach($comments as $comment){
                            $commentArr[$comment->getIDPost()][] = $comment;
                        }

                        $queryLikes = $db->prepare("SELECT idPost, COUNT(idLikes) FROM likes GROUP BY idPost");
                        
                        if($queryLikes->execute()){
                            $postLikes = $queryLikes->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

                            //Array of Post will be iterated in the view
                            
                            include "../../View/Home/homeView.php";
                        }
                    }
                }
            }
 
        } catch (PDOException $e) {
            //Free resources
            $result = null;
            $query = null;
            $db = null;
            echo 'Database Error : ' . $e->getMessage();
        }
    }

?>