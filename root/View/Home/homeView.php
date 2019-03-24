<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">

    <script>
      <?php
        if(isset($_SESSION['post'])){

          if($_SESSION['post']) echo 'alert("Post Successful!")';
          else echo 'alert("Post Failed! Please try again in a few minutes!")';

          unset($_SESSION['post']);
        }

        if(isset($_SESSION['comment'])){
          if($_SESSION['comment']) echo 'alert("Comment Successful!")';
          else echo 'alert("Comment Failed! Please try again in a few minutes!")';

          unset($_SESSION['comment']);
        }

        if(isset($_SESSION['like'])){
          if($_SESSION['like']) echo 'alert("Liked Successfully!);';
          else echo 'alert("Failed to like post! Try again in a few minutes");';

          unset($_SESSION['like']);
        }
      ?>
    </script>
  </head>
  
  <body class = "m-0 p-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
      <div class="container-fluid"> 
        <a class="navbar-brand" href="#">
          <i class="fa d-inline fa-lg fa-stop-circle"></i>
          <b> Twistagram </b>
        </a>
        <form class="form-inline my-2 my-lg-0"> 
          <input class="form-control mr-sm-2" type="text" placeholder="Search"> 
          <button class="btn my-2 my-sm-0 btn-outline-light text-dark" type="submit">
            <i class="fa fa-search fa-fw"></i> Search
          </button> 
        </form> 
        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar16">
          <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse" id="navbar16">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"> <a class="nav-link active" href="#">Home</a> </li>
            <li class="nav-item"> <a class="nav-link" href="../Profile/profileController.php?target=about">Profile</a> </li>
            <li class="nav-item"> <a class="nav-link" href="../Login/loginController.php">Logout</a> </li>
          </ul> 
        </div>
      </div>
    </nav>
    <div class="py-5">
    <div class="row m-0 p-0">
          <!-- Bagian Profil Singkat User -->
          <div class="col-md-3 mx-auto">
              <!-- Di sini bagian profil singkat user, perlu sesuaikan data user -->
            <div class="card"> 
              <img class="card-img-top" src="<?php echo ($userArr[$_SESSION['user_id']]->getProfPic() == null ? $placeholderImage :  $userArr[$_SESSION['user_id']]->getProfPic())?>">
              <div class="card-body">
                <h4 class="card-title"> <?php echo $userArr[$_SESSION['user_id']]->getDisplayName()?> </h4>
                <div class="btn-group"> 
                  <a href="../Profile/profileController.php?target=follower" class="btn btn-primary mr-2"> Followers </a>
                  <a href="../Profile/profileController.php?target=following" class="btn btn-primary mr-2"> Following </a>
                  <a href="../Profile/profileController.php?target=about" class="btn btn-primary ms-auto"> My Profile </a>
                </div>              
              </div>
            </div>
          </div>

          <!-- Bagian Post -->
          <div class="col-md-6 m-0 p-0">
            <div class="row m-0 p-0">
              <div class="bg-primary col-md-12">
                <h4 class="p-0 m-0 my-1 text-light">Post Something...</h4>
              </div>
            </div>
            <form action="postMechanism.php" enctype="multipart/form-data" method="post">
              <div class="form-group" style=""> 
                <input name = "postText" type="text" class="form-control mb-2 mt-2" id="form9" placeholder="What's happening?"  max = 255 required>
                <div class="card" id = "preview">
                  <!-- Untuk preview Image/Video yang diupload -->
                </div>
                <button type="submit" class="btn btn-primary"> Submit </button>
                <label id="fileLabel" for="uploadGraphic" class="btn btn-primary" style = "margin: 0;"> Upload Image </label>
                <button type="button" class="btn btn-info" id = "clearInput"> Clear Image </button>
                <input name = "graphicFile" id="uploadGraphic" type="file" accept = "image/*">              
              </div>
            </form>
            <!-- Di sini bagian post, perlu diiterate pakai data hasil query -->
            <div>
              <!-- Main post -->
              <div>
                <!-- Main post -->
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
                                  echo "<button class = 'btn btn-default nav-link' onclick = 'window.location.href = 'likeMechanism.php?target={$post->getIDPost()}&source=home'>" ;
                                    echo "<i class='fa fa-lg fa-thumbs-up'></i>" ;
                                    echo ' ' . (array_key_exists($post->getIDPost(), $postLikes) ? $postLikes[$post->getIDPost()][0] : 0);
                                  echo "</button>" ;
                              echo "</li>";
                              echo "<li class='nav-item ml-auto mt-1 mr-1'>";
                                  echo "<i> <b class = ''> {$post->getDatePost()} </b> </i>" ;
                              echo "</li>";
                          echo "</ul>";
              
                          echo "<div class = 'row m-0 border' id = '{$post->getIDPost()}' style = 'display: none;'>";
                              echo "<form action='commentMechanism.php' method='post'>";
                                  echo "<div class='form-horizontal' style=''>";
                                      echo "<div class = 'input-group'>";
                                          echo "<input name = 'commentText' type='text' class='form-control input-lg' id='formComment' placeholder = 'Comment on this'  max = 255 required>";
                                          echo "<div class = 'input-group-btn'>";
                                          echo '<input type = "hidden" name = "source" value = "home">';
                                          echo "<button type='submit' class='btn btn-primary'> Comment </button>";
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
            </div>
          </div>

          <div class = 'mx-auto col-md-2'>
          </div>


          <!-- Bagian Hashtag -->
          <!-- <div class="mx-auto col-md-2">
            <div class="card text-white bg-primary mb-3">
              <div class="card-header">Hashtag</div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item text-body">#satu</li>
                  <li class="list-group-item text-body">#dua</li>
                  <li class="list-group-item text-body">#tiga</li>
                  <li class="list-group-item text-body">#empat</li>
                  <li class="list-group-item text-body" contenteditable="true">#lima</li>
                </ul>
              </div>
            </div>
          </div> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo>
    <script>
    //Adopted from https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file
      function updateImageDisplay() {
        while(preview.firstChild) {
          preview.removeChild(preview.firstChild);
        }

        var curFiles = input.files;
        if(curFiles.length !== 0) {
          for(var i = 0; i < curFiles.length; i++) {
            if(validFileType(curFiles[i])) {
              var image = document.createElement('img');
              image.class = 'card-img-top';
              image.src = window.URL.createObjectURL(curFiles[i]);
              image.style ='height: 100%; width: 100%; object-fit: scale-down;';

              preview.appendChild(image);
              label.innerText = 'Change Image';
              preview.setAttribute('style','')
              clearInput.setAttribute('style','')
              clearInput.onclick = function(){
                //Reset Input Image nya
                input.type ='';
                input.type ='file';
                clearInput.setAttribute('style','');
                preview.setAttribute('style','');
                label.innerText = 'Upload Image';
                preview.innerHTML = '';
              }
            } else {
              alert("Invalid file type for file chosen! Only accepts PNG or JPEG/JPG files!");
              clearInput.setAttribute('style','display:none;');
              label.innerText = 'Upload Image';
              clearInput.onclick = '';
              preview.innerHTML = '';
            }
          }
        }
      }

      let input = document.getElementById('uploadGraphic');
      let clearInput = document.getElementById("clearInput");
      let preview = document.getElementById('preview');
      let label = document.getElementById("fileLabel");
      
      input.setAttribute('style','display:none;');
      clearInput.setAttribute('style','display:none;');
      input.addEventListener('change', updateImageDisplay);
      preview.setAttribute('style','display:none;');

      var fileTypes = [
        'image/jpeg',
        'image/pjpeg',
        'image/png'
      ]

      function validFileType(file) {
        for(var i = 0; i < fileTypes.length; i++) {
          if(file.type === fileTypes[i]) {
            return true;
          }
        }

        return false;
      }

      function displayCommentInput(postID){
        let form =  document.getElementById(postID);

        if(form.getAttribute('style') == 'display: none;')
          form.setAttribute('style', 'display:block;');
        else form.setAttribute('style', 'display: none;');
      }

      $(document).ready(
        function(){
          input.type ='';
          input.type ='file';
        }
      );
    </script>
  </body>
</html>