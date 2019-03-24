<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  </head>
  
  <body class = "m-0 p-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-fluid"> 
            <a class="navbar-brand" href="../Home/homeController.php">
                <i class="fa d-inline fa-lg fa-stop-circle"></i>
                <b> Twistagram </b>
            </a>
            <form class="form-inline my-2 my-lg-0" action = 'searchController.php' method = 'post'> 
                <input class="form-control mr-sm-2" type="text" placeholder="Search other people..." required name = 'keyword'> 
                <button class="btn my-2 my-sm-0 btn-outline-light text-dark" type="submit">
                    <i class="fa fa-search fa-fw"></i>Search
                </button> 
            </form>
            <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar16">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbar16">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link" href="../Home/homeController.php">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../Profile/profileController.php?target=about">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../Login/loginController.php">Logout</a> </li>
                </ul> 
            </div>
        </div>
    </nav>

    <div class="py-5">
        <div class="row m-0 p-0">
            <div class="col-md-3 ml-4">
                <div class="card"> 
                    <img class="card-img-top" src="<?=($searchResult[$_SESSION['user_id']]->getProfPic() == null ? $placeholderImage : $searchResult[$_SESSION['user_id']]->getProfPic())?>">
                    <div class="card-body">
                        <h4 class="card-title"> <?=$searchResult[$_SESSION['user_id']]->getDisplayName()?> </h4>
                        <div class="btn-group"> 
                            <a href="../Profile/profileController.php?target=follower" class="btn btn-primary mr-2"> Followers </a>
                            <a href="../Profile/profileController.php?target=following" class="btn btn-primary mr-2"> Following </a>
                            <a href="../Profile/profileController.php?target=about" class="btn btn-primary ms-auto"> My Profile </a>
                        </div>              
                    </div>
                </div>
            </div>

            <div class="col-md-6 m-0 p-0">
                <div class="py-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Search Result</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if(!isset($searchResult)) echo '<p> No result </p>';
                    else{
                        foreach($searchResult as $result){
                            echo "<div class='py-2' style=''>";
                                echo "<div class='container'>";
                                    echo "<div class='row'>";
                                        echo "<div class='col-md-12'>";
                                            echo "<div class='row'>";
                                                echo "<div class='col-md-2'>";
                                                    echo "<img class='img-fluid d-block rounded-circle' src='" . ($result->getProfPic() == null || $result->getProfPic() == '' ? $placeholderImage : $result->getProfPic()) . "' width='100' height='150 150 100' style=''>";
                                                echo "</div>";
    
                                                echo "<div class='col-md-5'>";
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-md-12'>";
                                                            echo "<div class='row'>";
                                                                echo "<div class='col-md-12'>";
                                                                    echo "<h4 class=''> {$result->getDisplayName()} </h4>";
                                                                echo "</div>";
                                                                echo "<div class='col-md-12'>";
                                                                    echo "<p class='text-monospace'> {$result->getBio()}</p>";
                                                                echo "</div>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
    
                                                echo "<div class='col-md-5 text-right' style=''>";
                                                    if(in_array($result->getIDUser(), $followings)) echo '<a class="btn w-25 my-3 btn-secondary" href="../follow.php?unfollow=' . $result->getIDUser() . '"> Following </a>';
                                                    else echo "<a class='btn w-25 my-3 btn-light' href='../follow.php?follow={$result->getIDUser()}'> Follow </a>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>

            <div class = 'col-md-3 ms-auto'> </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>