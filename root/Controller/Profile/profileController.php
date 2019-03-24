<?php
    session_start();

    if(!isset($_SESSION['user_id'])) header('Location: ../Login/loginController.php');

    //By default akan mengarah ke About
    $includeView;

    if(isset($_GET['target'])){
        $target = $_GET['target'];

        try {
            include '../../Model/connection.php';

            $userQuery = $db->prepare("SELECT idUser, dispName, gender, birthDate, email, dateRegistered, bio, phoneNum, profPic FROM user");

            if($userQuery->execute()){
                include '../../Model/User.php';
                $userList = $userQuery->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $userArr;

                //Susun supaya IDUser menjadi index dari objectnya di associative array
                foreach($userList as $user){
                    //basically, group User Object by UserIDs
                    $userArr[$user->getIDUser()] = $user;
                }
                $placeholderImage = '../../Images/User/avatar.png';

                if($target === 'timeline'){
                    $postQuery = $db->prepare("SELECT * FROM post WHERE idUser = :userID ORDER BY datePost DESC");
                    $postQuery->bindParam(':userID', $_SESSION['user_id']);

                    if($postQuery->execute()){
                        include '../../Model/Post.php';

                        $userPosts = $postQuery->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');

                        $commentQuery = $db->prepare("SELECT * FROM comment WHERE idPost IN (SELECT idPost FROM post WHERE idUser = :userID) ORDER BY idPost ASC, dateComment ASC");
                        $commentQuery->bindParam(':userID', $_SESSION['user_id']);

                        if($commentQuery->execute()){
                            include '../../Model/Comment.php';

                            $comments = $commentQuery->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');                    
                            $commentArr;

                            foreach($comments as $comment){
                                $commentArr[$comment->getIDPost()][] = $comment;
                            }

                            $likeQuery = $db->prepare("SELECT idPost, COUNT(idLikes) FROM likes GROUP BY idPost");

                            if($likeQuery->execute()){
                                $postLikes = $likeQuery->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

                                $likedQuery = $db->prepare("SELECT idPost FROM likes WHERE idUser = :userID");
                                $likedQuery->bindParam(':userID', $_SESSION['user_id']);
    
                                if($likedQuery->execute()){
                                    $likedPosts = $likedQuery->fetchAll(PDO::FETCH_COLUMN);
                                    
                                    //Array of Post will be iterated in the view
                                
                                    $includeView = 'timelineView.php';
                                }
                            }
                        }
                    }
                }
                else if($target === 'about'){
                    $mainUser = $userArr[$_SESSION['user_id']];

                    $includeView = 'aboutView.php';
                }
                else if($target === 'photo'){
                    $postQuery = $db->prepare("SELECT imgDirectory FROM post WHERE idUser = :userID AND (imgDirectory <> null OR imgDirectory <> '') ORDER BY datePost DESC");
                    $postQuery->bindParam(':userID', $_SESSION['user_id']);

                    if($postQuery->execute()){
                        $photos = $postQuery->fetchAll(PDO::FETCH_NUM);

                        $includeView = 'photoView.php';
                    }
                }
                else if($target === 'follower'){
                    $followerQuery = $db->prepare("SELECT idFollower, CASE WHEN idFollower IN (SELECT idFollowed FROM relationship WHERE idFollower = :userID) THEN 'yes' ELSE 'no' END AS follback FROM relationship WHERE idFollowed = :userID ORDER BY dateFollow DESC");
                    $followerQuery->bindParam(':userID', $_SESSION['user_id']);

                    if($followerQuery->execute()){
                        $followers = $followerQuery->fetchAll(PDO::FETCH_ASSOC);

                        $includeView = 'followerView.php';
                    }
                }
                else if($target === 'following'){
                    $followedQuery = $db->prepare("SELECT idFollowed FROM relationship WHERE idFollower = :userID");
                    $followedQuery->bindParam(':userID', $_SESSION['user_id']);

                    if($followedQuery->execute())
                        $followings = $followedQuery->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        } catch (PDOException $e) {
            echo 'Database Error : ' . $e->getMessage();
        }
    }

    include '../../View/Profile/profileView.php';
?>