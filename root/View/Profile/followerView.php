<div class="py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Follower</h1>
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8" style="">
                <input type="search" class="form-control w-100 text-center form-control-sm my-2" id="inlineFormInputGroup" placeholder="Search" style="">
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
</div>

<?php
    print_r($followers);

    // foreach($followers as $follower){
    //     echo "<div class='py-2' style=''>";
    //         echo "<div class='container'>";
    //             echo "<div class='row'>";
    //                 echo "<div class='col-md-12'>";
    //                     echo "<div class='row'>";
    //                         echo "<div class='col-md-2'>";
    //                             echo "<img class='img-fluid d-block rounded-circle' src='https://static.pingendo.com/img-placeholder-1.svg' width='100' height='150 150 100' style=''>";
    //                         echo "</div>";

    //                         echo "<div class='col-md-5'>";
    //                             echo "<div class='row'>";
    //                                 echo "<div class='col-md-12'>";
    //                                     echo "<div class='row'>";
    //                                         echo "<div class='col-md-12'>";
    //                                             echo "<h4 class=''>Nama</h4>";
    //                                         echo "</div>";
    //                                         echo "<div class='col-md-12'>";
    //                                             echo "<p class='text-monospace'>Monospace. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>";
    //                                         echo "</div>";
    //                                     echo "</div>";
    //                                 echo "</div>";
    //                             echo "</div>";
    //                         echo "</div>";

    //                         echo "<div class='col-md-5 text-right' style=''>";
    //                             echo "<a class='btn w-25 my-3 btn-light' href='#'>Follow</a>";
    //                         echo "</div>";
    //                     echo "</div>";
    //                 echo "</div>";
    //             echo "</div>";
    //         echo "</div>";
    //     echo "</div>";
    // }
?>

<div class="py-2" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-fluid d-block rounded-circle" src="https://static.pingendo.com/img-placeholder-1.svg" width="100" height="150 150 100" style="">
                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="">Nama</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="text-monospace">Monospace. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 text-right" style="">
                        <a class="btn w-25 my-3 btn-light" href="#">Follow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>