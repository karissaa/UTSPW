<?php
    // print_r($photos);

    if(isset($photos)){
        $totalPhoto = sizeof($photos);

        for($ctr = 0; $ctr < $totalPhoto; $ctr++){
            if($ctr % 4 === 0){
                echo '<div class="py-3">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-3"> ';
                                echo '<img class="img-fluid d-block" src="' . $photos[$ctr][0] . '">';
            }
            else echo '<img class="img-fluid d-block" src="' . $photos[$ctr][0] . '">';

            if($ctr % 4 == 0){
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }
?>