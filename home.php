<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>

        <link rel="stylesheet" href="./css/bootstrap-4.0.0.min.css">

        <script src="./js/jquery-3.2.1.min.js"></script>
        <script src="./js/popper-1.12.9.min.js"></script>
        <script src="./js/bootstrap-4.0.0.min.js"></script>
    </head>
    <body class = "col-sm-12">
        <div class = "col-sm-2"> </div>
        <div class = "col-sm-8">
            <!-- To post new stuffs -->
            <div class = "new-post">
                <div class = "col-sm-12">
                    <textarea name="" id="" cols="100" rows="3"></textarea>
                </div>
                <div class = "col-sm-12">
                    <!-- Small button to embed stuffs (images, etc) -->
                    <div class = "col-sm-6">
                        <button> Post Image</button>
                    </div>
                    <div class = "col-sm-3"></div>
                    <!-- Button to post something -->
                    <div class = "col-sm-3">
                        <button> Post </button>
                    </div>
                </div>
            </div>

            <!-- 1 div = 1 post + comments -->
            <div class="post col-sm-12">
                <!-- Post here -->
                <div class = "col-sm-12">
                    <!-- Display User that posts -->
                    <div class = "col-sm-12">
                        <!-- Profile Picture -->
                        <img src="">

                        <!-- Username and stuffs -->
                        <div></div>
                    </div>

                    <!-- Images are optional in a post, will be set to show if there's any image -->
                    <img src="" display = "hidden">

                    <!-- Texts for content of the post -->
                    <div class = "col-sm-12">
                        
                    </div>

                    <div>
                        <div class="col-sm-2"></div>
                        <!-- Like Button here -->
                        <div class="col-sm-2"> 
                            <button> LIKE </button>
                        </div>
                        <div class="col-sm-2"></div>

                        <div class="col-sm-2"></div>
                        <!-- Comment Button Here -->
                        <div class="col-sm-2"> 
                            <button> COMMENT </button>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>

                <!-- Comments here -->
                <div class = "col-sm-12">
                    <div class = "col-sm-2"></div>
                    <div class = "col-sm-10">
                        <!-- New div = new column -->
                        <div class = "comment">
                            <!-- Profile picture of commentator -->
                            <img src="" alt="">

                            <!-- The comments -->
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class = "col-sm-2"> </div>
    </body>
</html>