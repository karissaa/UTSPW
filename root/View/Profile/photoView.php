<div class = "col-md-2 mx-auto"> </div>
<div class = "col-md-8 mx-auto">
<?php
    // print_r($photos);

    if(isset($photos)){
        $totalPhoto = sizeof($photos);

        for($ctr = 0; $ctr < $totalPhoto; $ctr++){
            if($ctr % 4 === 0 && $ctr > 0){
                echo '<div class="py-3">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-2"> ';
                                echo '<img class="img-fluid" style = \'height: 350px; width: 250px; object-fit: scale-down;\' src="' . $photos[$ctr][0] . '">';
            }
            else echo '<img class="img-fluid" style = \'height: 350px; width: 250px; object-fit: scale-down;\' src="' . $photos[$ctr][0] . '">';

            if($ctr % 4 === 0 && $ctr > 0){
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }
?>
</div>
<div class = "col-md-2 mx-auto"> </div>
