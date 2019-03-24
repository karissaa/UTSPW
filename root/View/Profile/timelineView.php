<div class = "col-md-3 mx-auto"> </div>
<div class = "col-md-6 mx-auto">
<?php
    if($userPosts != null && isset($userPosts)){
        foreach($userPosts as $post){
            echo "<div class='row border mt-3 m-0'>";
                echo "<div class='p-3 col-md-2 bg-white border' style=''>" ;
                    echo "<img class='d-block rounded-circle img-fluid' src='" . ($userArr[$post->getIDUser()]->getProfPic() == null ? $placeholderImage :  $userArr[$post->getIDUser()]->getProfPic()) . "' style = 'height: 100%; width: 100%; object-fit: scale-down;'>"; 
                echo "</div>";

                echo "<div class='bg-white text-dark col-md-10' style=''>";
                    echo "<div class='row'>";
                        echo "<div class='col-md-12 m-0 p-0'>";
                            echo "<h5 class='border bg-primary text-light px-2'> {$userArr[$post->getIDUser()]->getDisplayName()} </h5>";
                            echo "<p class ='text-dark px-2'> {$post->getText()} </p>";
                            echo $post->getImageDir() == null ? '' : "<img class='d-block img-fluid' src='{$post->getImageDir()}' style = 'height: 80%; width: 80%; object-fit: scale-down;' alt = ''>";         
                        echo "</div>";
                    echo "</div>";
                
                    echo "<div class='tab-content mt-2'>";
                        echo "<div class='tab-pane fade' id='tabthree' role='tabpanel'>";
                            echo "<p class=''>When I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms.</p>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";

            echo "<ul class='nav nav-pills border-left border-right border-bottom'>";
                echo "<li class='nav-item'>";
                    echo "<button class = 'btn btn-default nav-link' onclick = 'displayCommentInput({$post->getIDPost()})'>" ;
                        echo "<i class='fa fa-lg fa-comment'></i>" ;
                        echo ' ' . (array_key_exists($post->getIDPost(), $commentArr) ? sizeof($commentArr[$post->getIDPost()]) : 0);
                    echo "</button>" ;
                echo "</li>";
                echo "<li class='nav-item'>";
                    echo "<button class = 'btn btn-default nav-link' onclick = 'window.location = '../Home/likeMechanism.php?target={$post->getIDPost()}&source=profile'>" ;
                        echo "<i class='fa fa-lg fa-thumbs-up'></i>" ;
                        echo ' ' . (array_key_exists($post->getIDPost(), $postLikes) ? $postLikes[$post->getIDPost()][0] : 0);
                    echo "</button>" ;
                echo "</li>";
                echo "<li class='nav-item ml-auto mt-1 mr-1'>";
                    echo "<i> <b class = ''> {$post->getDatePost()} </b> </i>" ;
                echo "</li>";
            echo "</ul>";

            echo "<div class = 'row m-0 border' id = '{$post->getIDPost()}' style = 'display: none;'>";
                echo "<form action='../Home/commentMechanism.php' method='post'>";
                    echo "<div class='form-horizontal' style=''>";
                        echo "<div class = 'input-group'>";
                            echo "<input name = 'commentText' type='text' class='form-control input-lg' id='formComment' placeholder = 'Comment on this'  max = 255 required>";
                            echo "<div class = 'input-group-btn'>";
                            echo "<button type='submit' class='btn btn-primary'> Comment </button>";
                            echo '<input type = "hidden" name = "source" value = "profile">';
                            echo "</div>";    
                        echo "</div>";
                        echo "<input name = 'postID' type = 'hidden' value = '{$post->getIDPost()}'>";
                    echo "</div>";
                echo "</form>";
            echo "</div>";
            
            //Comment Section
            if(array_key_exists($post->getIDPost(), $commentArr)){
                echo "<div>";
                    foreach($commentArr[$post->getIDPost()] as $postComment){
                        echo "<div class='row m-0'>";
                            echo "<div class='col-md-1' style = ''> </div>";

                            echo "<div class='col-md-1 bg-grey' style=''>" ;
                                echo "<img class='d-block img-fluid' src='" . ($userArr[$postComment->getIDUser()]->getProfPic() == null ? $placeholderImage :  $userArr[$postComment->getIDUser()]->getProfPic()) . "' style = 'height: 100%; width: 100%; object-fit: scale-down;'>"; 
                            echo "</div>";

                            echo "<div class='text-light col-md-10' style=''>";
                                echo "<div class='row'>";
                                    echo "<div class='col-md-12 m-0 p-0 border'>";
                                        echo "<div class='tab-pane fade show active' id='tabone' role='tabpanel'>";
                                            echo "<p class='pl-2 m-0 bg-primary'> {$userArr[$postComment->getIDUser()]->getDisplayName()} </p>";
                                            echo "<p class='text-dark p-2'> {$postComment->getText()} </p>";
                                            echo "<p class='text-dark m-auto' style = 'text-align: right;'> {$postComment->getDateComment()} </p>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                echo "</div>";
            }
        }
    }
    else{
        echo '<p> NO POST TO SHOW </p> </br>';
    }

?>
</div>
<div class = "col-md-3 mx-auto"> </div>

<script>
    function displayCommentInput(postID){
        let form =  document.getElementById(postID);

        if(form.getAttribute('style') == 'display: none;')
            form.setAttribute('style', 'display:block;');
        else form.setAttribute('style', 'display: none;');
    }
</script>