<div class="py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Following</h1>
            </div>
        </div>
    </div>
</div>

<!-- <div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8" style="">
                <input type="search" class="form-control w-100 text-center form-control-sm my-2" id="inlineFormInputGroup" placeholder="Search" style="">
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
</div> -->

<?php
    // print_r($followings);
    foreach($followings as $follower){
        echo "<div class='py-2' style=''>";
            echo "<div class='container'>";
                echo "<div class='row'>";
                    echo "<div class='col-md-12'>";
                        echo "<div class='row'>";
                            echo "<div class='col-md-2'>";
                                echo "<img class='img-fluid d-block rounded-circle' src='" . ($userArr[$follower['idFollowed']]->getProfPic() == null || $userArr[$follower['idFollowed']]->getProfPic() == '' ? $placeholderImage : $userArr[$follower['idFollowed']]->getProfPic()) . "' width='100' height='150 150 100' style=''>";
                            echo "</div>";

                            echo "<div class='col-md-5'>";
                                echo "<div class='row'>";
                                    echo "<div class='col-md-12'>";
                                        echo "<div class='row'>";
                                            echo "<div class='col-md-12'>";
                                                echo "<h4 class=''> {$userArr[$follower['idFollowed']]->getDisplayName()} </h4>";
                                            echo "</div>";
                                            echo "<div class='col-md-12'>";
                                                echo "<p class='text-monospace'> {$userArr[$follower['idFollowed']]->getBio()}</p>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";

                            echo "<div class='col-md-5 text-right' style=''>";
                                echo '<a class="btn w-25 my-3 btn-secondary" href="../follow.php?unfollow=' . $userArr[$follower['idFollowed']]->getIDUser() . '"> Following </a>';
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
?>