<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
    
    <script>
        <?php
            if(isset($_SESSION['follow'])){
                if($_SESSION['follow']) echo 'alert("Followed Successfully!")';
                else echo 'alert("Failed to Follow! Try again in a few minutes!")';
        
                unset($_SESSION['follow']);
            }

            if(isset($_SESSION['unfollow'])){
                if($_SESSION['unfollow']) echo 'alert("Unfollowed Successfully!")';
                else echo 'alert("Failed to unfollow! Please try again in a few minutes!")';
      
                unset($_SESSION['unfollow']);
            }

            if(isset($_SESSION['comment'])){
                if($_SESSION['comment']) echo 'alert("Comment Successful!")';
                else echo 'alert("Comment Failed! Please try again in a few minutes!")';
      
                unset($_SESSION['comment']);
            }

            if(isset($_SESSION['profile_edit'])){
                if($_SESSION['profile_edit']) echo 'alert("Successfully editted profile!")';
                else echo 'alert("Failed to edit profile! Please try again in a few minutes!")';
      
                unset($_SESSION['profile_edit']);
            }
        ?>
    </script>
    </head>

    <body class="m-0 p-0">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top m-0">
            <div class="container-fluid"> 
                <a class="navbar-brand" href="#">
                    <i class="fa d-inline fa-lg fa-stop-circle"></i>
                    <b> Twistagram </b>
                </a>
                <form class="form-inline my-2 my-lg-0"> 
                    <input class="form-control mr-sm-2" type="text" placeholder="Search other people..."> 
                    <button class="btn my-2 my-sm-0 btn-outline-light text-dark" type="submit"><i class="fa fa-search fa-fw"></i>Search</button> 
                </form> 
                <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar16">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar16">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link" href="../Home/homeController.php">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="#">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../Login/loginController.php">Logout</a> </li>
                    </ul> 
                </div>
            </div>
        </nav>

        <div class="m-0 p-0"></div>
        
        <div class="container-fluid m-0 p-0">
            <div class="col-md-12 m-0 p-0">
                <!-- Cover Photo yang Gede -->
                <div class="m-0 py-5 h-100" style="	background-image: url(../../Images/Server/default.jpg);	background-position: center; background-size: 100%; object-fit: scale-down;">
                    <img class="d-block rounded-circle float-left p-0 m-0 ml-5 mb-2" src="<?= (($userArr[$_SESSION['user_id']]->getProfPic() == null || $userArr[$_SESSION['user_id']]->getProfPic() == '') ? $placeholderImage : $userArr[$_SESSION['user_id']]->getProfPic())?>" height="200px" style="transform: translateY(155px);" width="200px">
                    <div class="m-0 p-5"></div>
                    <div class="m-0 p-3"></div>
                </div>

                <!-- NavBar untuk pilih window -->
                <div class="m-0 pb-2" id="nama_dan_nav" style="	background-color:black">
                    <div class="row m-0 p-0">
                        <div class="col-md-3 m-0 p-0"></div>
                        <div class="col-md-9 m-0 p-0">
                            <h4 style="" class="m-0 pt-1 pb-2 text-white"> <?php echo $userArr[$_SESSION['user_id']]->getDisplayName(); ?> </h4>
                            <ul class="nav nav-pills">
                                <li class="nav-item"> <a href="<?= ($target === 'timeline' ? '' : '?target=timeline')?>" class="nav-link <?= ($target === 'timeline' ? 'active' : '')?>">  Timeline</a> </li>
                                <li class="nav-item"> <a href="<?= ($target === 'about' ? '' : '?target=about')?>" class="nav-link <?= ($target === 'about' ? 'active' : '')?>" >    About</a> </li>
                                <li class="nav-item"> <a href="<?= ($target === 'follower' ? '' : '?target=follower')?>" class="nav-link <?= ($target === 'follower' ? 'active' : '')?>" > Followers</a> </li>
                                <li class="nav-item"> <a href="<?= ($target === 'following' ? '' : '?target=following')?>" class="nav-link <?= ($target === 'following' ? 'active' : '')?>" >Following</a> </li>
                                <li class="nav-item"> <a href="<?= ($target === 'photo' ? '' : '?target=photo')?>" class="nav-link <?= ($target === 'photo' ? 'active' : '')?>" >    Photos</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Include Views here -->
        <?php 
            if(isset($includeView)) include $includeView;
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>