<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <?php
            // if(isset($_GET['failed_signup'])) echo '<script> alert("Sign Up Failed"); </script>'; 
            // else if(isset($_GET['ok_signup'])) echo '<script> alert("Sign Up Successful!"); </script>';

            if(isset($_SESSION['failed'])){
                if($_SESSION['failed'] == 'login') echo '<script> alert("Login Failed"); </script>';
                if($_SESSION['failed'] == 'signup') echo '<script> alert("Sign Up Failed"); </script>';
                if($_SESSION['failed'] == 'false') echo '<script> alert("Sign Up Successful!"); </script>';
            }

            session_destroy();
        ?>
    </head>

    <body>
        <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-primary py-0">
            <div class="container-fluid"> <a class="navbar-brand" href="#">
                <i class="fa d-inline fa-lg fa-stop-circle"> </i>
                <b> Twistagram </b>
            </a>
            <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar16">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar16">
                <ul class="navbar-nav ml-auto"></ul>
            </div>
            </div>
        </nav>

        <!-- Slider goes in here -->
        <div class="bg-light m-0 p-0" style = "height: 715px;" >
            <div class="container-fluid m-0 p-0" style = "height: 715px;">
                <div class="row  m-0 p-0" style = "height: 715px;">
                    <div class="d-flex flex-column justify-content-center p-0 m-0 w-100 col-md-10" style = "height: 715px;">
                        <div class="carousel slide m-0 p-0" style = "height: 715px;" data-ride="carousel" id="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active"> 
                                    <img class="d-block img-fluid w-100" src="../../Images/Server/LoginCarousel/followinterest.png">
                                </div>
                                <div class="carousel-item"> 
                                    <img class="d-block img-fluid w-100" src="../../Images/Server/LoginCarousel/hear.png">
                                </div>
                                <div class="carousel-item"> 
                                    <img class="d-block img-fluid w-100" src="../../Images/Server/LoginCarousel/join.png">
                                </div>
                            </div> 
                            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> 
                                <span class="carousel-control-prev-icon"></span> 
                                <span class="sr-only">Previous</span> 
                            </a> 
                            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon"></span> 
                                <span class="sr-only">Next</span> 
                            </a>
                        </div>
                    </div>
                    
                    <div class="mx-auto col-10 bg-white col-md-2 pt-2" style="" id="loginForm">
                        <h2 class="mb-4"> Sign In </h2>

                        <!-- login form -->
                        <form action="<?php echo $post_destination?>" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email or username" id="form9" name="u_name">
                            </div>
                            <div class="form-group mb-3"> 
                                <input type="password" class="form-control" placeholder="Password" id="form10" name="password"> 
                            </div> 

                            <?php 
                                if(isset($_GET['failed_login'])) 
                                    echo '<div class = \'alert alert-danger col-sm-12\'> Invalid username or password!</div>';
                            ?>

                            <button type="submit" name="cobaSubmit" class="btn btn-primary"> Sign In </button>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mt-4">Don't have any account? Join (Brand) today.</h4>
                                <button class="btn btn-primary mt-2"  id = "signUpButton">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id = "signUpModal" class = "modal fade" tabindex = "-1" role = "dialog">
            <div class = "modal-dialog" role = "document">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h3 id = "title"> Sign Up </h3>
                    </div>

                    <div class = "modal-body">
                        <div class="col-sm-2"></div>

                        <div class = "col-sm-8">
                            <div class = "col-md-12" id = "modal-details">
                                <form action="<?php echo $signUpDestination;?>" method="POST">
                                    <div class="classform">
                                        <label for="userdisplayName">Display Name </label>
                                        <input type="text" class="form-control" name="userDisplayName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userName"> Username </label> <!-- username bisa digunakan untuk login, display name tidak bisa -->
                                        <input type="text" class="form-control" name="userName" required> <!-- buat login -->
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="selectGender" class="form-control" required>   
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Non-Binary">Non-Binary</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="userEmail">Email</label>
                                        <input type="email" name="userEmail" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userPassword">Password</label>
                                        <input type="password" minlength="8" name="userPassword" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userPasswordConfirm">Confirm Your Password </label>
                                        <input type="password" minlength="8" name="userPasswordConfirm" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userBirthday">Birthday</label>
                                        <input type="date" name="userBirthday" class="form-control" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="col-sm-2"></div>
                    </div>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
        <script>
            $("#signUpButton").on("click", function(e){$("#signUpModal").modal("show");});
        </script>
    </body>
</html>