<div class = 'py-5'>
    <div>
        <div class = 'row-m-0 p-0'>
            <div class="mx-auto col-md-6">
                <div class="row border mt-3">
                    <div class="bg-white text-dark col-md-12 m-0 p-0" style="">
                        <h1 class="m-auto p-2 bg-primary"> About Me <br> </h1>
                        <div class="row">
                            <div class="col-md-12 m-0 p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="fa fa-user text-primary mr-2"></i>&nbsp; <?=$mainUser->getDisplayName();?> </li>
                                    <li class="list-group-item"><i class="fa fa-venus-mars text-primary mr-2"></i> <?=$mainUser->getGender();?> </li>
                                    <li class="list-group-item"><i class="fa fa-birthday-cake text-primary mr-2"></i> <?=$mainUser->getBirthDate();?> </li>
                                    <li class="list-group-item"><i class="fa fa-pencil text-primary mr-2"></i>&nbsp; <?=$mainUser->getBio();?> </li>
                                    <li class="list-group-item"><i class="fa fa-phone text-primary mr-2"></i> <?=$mainUser->getPhoneNum();?> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "col-md-12">
                    <button class = "btn btn-primary mt-2 btn-block" id = "editProfileButton"> Edit Profile </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id = "editProfileModal" class = "modal fade" tabindex = "-1" role = "dialog">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <div class = "modal-header">
                <h3 id = "title"> Edit Profile </h3>
            </div>
            <div class = "modal-body">
                <div class = "col-md-12" id = "modal-details">
                    <form action="editProfile.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="userDisplayName">Display Name </label>
                            <input type="text" class="form-control" name="userDisplayName" value="<?php if($mainUser->getDisplayName() !== null) echo $mainUser->getDisplayName();?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="selectGender" class="form-control" required>   
                                <option value="" disabled <?=$mainUser->getGender() == null ? 'selected' : '';?>> --Select-- </option>
                                <option value="Male" <?=$mainUser->getGender() == 'Male' ? 'selected' : '';  ?>> Male </option>
                                <option value="Female" <?=$mainUser->getGender() == 'Female' ? 'selected' : '';  ?>> Female </option>
                                <option value="Non-Binary" <?=$mainUser->getGender() == 'Non-Binary' ? 'selected' : '';  ?> >Non-Binary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userBirthdate"> Birthdate </label>
                            <input type="date" name="userBirthdate" class="form-control" required value="<?php if($mainUser->getBirthDate() !== null) echo $mainUser->getBirthDate();?>">
                        </div>
                        <div class="form-group">
                            <label for="userPhoneNumber">Phone Number</label>
                            <input type="text" name="userPhoneNumber" class="form-control" required value="<?php if($mainUser->getPhoneNum() !== null) echo $mainUser->getPhoneNum();?>">
                        </div>
                        <div class="form-group">
                            <label for="userBio"> User Bio </label>
                            <input type="text" name="userBio" class="form-control" value="<?php if($mainUser->getBio() !== null) echo $mainUser->getBio();?>">
                        </div>
                        <div class="form-group">
                            <input name = "profilePicture" id="uploadGraphic" type="file" accept = "image/*">
                        </div>
                        <div class="btn-group-justified">
                            <label id="fileLabel" for="uploadGraphic" class="btn btn-primary mx-auto" style = "margin: 0;"> Upload Image </label>
                            <button class="btn btn-primary mx-auto" type="submit">Submit</button>
                            <button type="button" class="btn btn-info mx-auto" id = "clearInput"> Clear Image </button>
                        </div>
                        <div class="card" id = "preview">
                            <!-- Untuk preview Image/Video yang diupload -->
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
    $("#editProfileButton").on("click", function(e){$("#editProfileModal").modal("show");});


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
                clearInput.setAttribute('style','display : none');
                preview.setAttribute('style','display : none');
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
      let label = document.getElementById('fileLabel');
      
      input.setAttribute('style','display:none;');
      clearInput.setAttribute('style','display:none;');
      input.addEventListener('change', updateImageDisplay);
      preview.setAttribute('style','display:none;');

      var fileTypes = [
        'image/jpeg',
        'image/jpg',
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
</script>