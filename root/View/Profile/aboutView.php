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

                            <div class = "col-md-12">
                                <button class = "btn btn-primary" id = "editProfileButton"> Edit Profile </button>
                            </div>
                        </div>
                    </div>
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
                <div class="col-sm-2"></div>
                <div class = "col-sm-8">
                    <div class = "col-md-12" id = "modal-details">
                        <form action="editProfile.php" method="POST">
                            <div class="classform">
                                <label for="userdisplayName">Display Name </label>
                                <input type="text" class="form-control" name="userDisplayName" value="<?php if($mainUser->getDisplayName() !== null) echo $mainUser->getDisplayName();?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="selectGender" class="form-control" required>   
                                    <option value="" disabled <?$mainUser->getGender() === null ? 'selected' : '';?>> --Select-- </option>
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
                                <input type="text" name="userPhoneNumber" class="form-control" required value="<?php if($mainUser->getPhoneNum() !== null) echo $mainUser->getBirthNum();?>">
                            </div>
                            <div class="form-group">
                                <label for="userBio"> User Bio </label>
                                <input type="text" name="userBio" class="form-control" value="<?php if($mainUser->getBio() !== null) echo $mainUser->getBio();?>">
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

<script>
    $("#editProfileButton").on("click", function(e){$("#editProfileModal").modal("show");});
</script>