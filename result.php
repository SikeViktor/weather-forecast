<?php
if ($_POST["unit"] == "celsius") $currentunit = "&deg;C";
else if ($_POST["unit"] == "fahrenheit") $currentunit = "&deg;F";
else $currentunit = "&deg;K";
?>

<!-- Jelenlegi időjárás -->
<div class="card card-1 col-8 mx-auto">
    <h4 class="mb-1">Pillanatnyi időjárás</h4>
    <div class="row">
        <div class="col-lg col-md-12">
            <div class="temp"><?php echo $current_temp . " " . $currentunit; ?></div>
            <div class="location">
                <h4><?php echo $cityName . ", " . $country; ?></h4>
            </div>
            <div class="mb-2">
                <?php echo $description; ?>
            </div>
        </div>
        <div class="col-lg col-md-12 align-self-center">
            <img class="img-fluid img-thumbnail" src=<?php echo "http://openweathermap.org/img/wn/$icon@2x.png" ?>>

        </div>
    </div>

</div>

<!-- Részletes adatok -->
<div class="card card-3 col-8 mx-auto">
    <h4>Részletes adatok</h4>
    <div class="row text-start">
        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/5664/5664979.png" alt="humidity" class="resultImage">
            <span class="resultLabel">Páratartalom: </span>
            <span class="resultValue"><?php echo $humidity; ?>%</span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/5789/5789553.png" alt="sense" class="resultImage">
            <span class="resultLabel">Érzékelés: </span>
            <span class="resultValue"><?php echo $feels_like. " " . $currentunit; ?></span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/5118/5118028.png" alt="mintemp" class="resultImage">
            <span class="resultLabel">Minimum hőmérséklet: </span>
            <span class="resultValue"><?php echo $temp_min. " " . $currentunit; ?></span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/9066/9066929.png" alt="maxtemp" class="resultImage">
            <span class="resultLabel">Maximum hőmérséklet: </span>
            <span class="resultValue"><?php echo $temp_max. " " . $currentunit; ?></span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/916/916979.png" alt="clouds" class="resultImage">
            <span class="resultLabel">Felhősség: </span>
            <span class="resultValue"><?php echo $clouds; ?> %</span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/2011/2011448.png" alt="clouds" class="resultImage">
            <span class="resultLabel">Szélsebesség: </span>
            <span class="resultValue"><?php echo $wind; ?> km/óra</span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3920/3920639.png" alt="sunrise" class="resultImage">
            <span class="resultLabel">Napkelte: </span>
            <span class="resultValue"><?php echo date("H:i:s", $sunrise); ?></span>
        </div>

        <div class="col-xxl-6 mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3920/3920728.png" alt="sunset" class="resultImage">
            <span class="resultLabel">Napnyugta: </span>
            <span class="resultValue"><?php echo date("H:i:s", $sunset); ?></span>
        </div>
    </div>


</div>

<!-- Előrejelzés 4 napra -->
<div class="card card-2 col-8 mx-auto">
    <h4>Előrejelzés <br /><span class="fs-5"> <?php echo "(" . substr($contents->list[0]->dt_txt, 0, -3) . " - " . substr($contents->list[count($contents->list) - 1]->dt_txt, 0, -3) . ")"; ?></span></h4>

    <div id="forecast" class="carousel carousel-dark slide" data-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#forecast" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 0"></button>
            <?php for ($i = 1; $i <= count($contents->list) / 3 - 1; $i++) {
                echo '<button type="button" data-bs-target="#forecast" data-bs-slide-to="' . $i . '" aria-label="Slide ' . $i . '"></button>';
            } ?>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        echo '<div class="col d-block w-100">
                                    <div class="row row1">' . round($contents->list[$i]->main->temp) . " " . $currentunit .'</div>
                                    <div class="row row2"><img class="img-fluid img-thumbnail" src="http://openweathermap.org/img/wn/' . $contents->list[$i]->weather[0]->icon . '@2x.png"/></div>
                                    <div class="row row3">' . substr($contents->list[$i]->dt_txt, 11, 5) . '</div>
                                    <div class="row row4">'  . $contents->list[$i]->weather[0]->description . '</div>
                                </div>';
                    }
                    ?>
                </div>
            </div>
            <?php for ($i = 3; $i < count($contents->list) - 3; $i += 3) {
                echo '<div class="carousel-item">
                            <div class="row">
                                
                                    <div class="col d-block w-100">
                                            <div class="row row1">' . round($contents->list[$i]->main->temp) . " " . $currentunit .'</div>
                                            <div class="row row2"><img class="img-fluid img-thumbnail" src="http://openweathermap.org/img/wn/' . $contents->list[$i]->weather[0]->icon . '@2x.png"/></div>
                                            <div class="row row3">' . substr($contents->list[$i]->dt_txt, 11, 5) . '</div>
                                            <div class="row row4">' . $contents->list[$i]->weather[0]->description . '</div>
                                    </div>
                                    <div class="col d-block w-100">
                                        <div class="row row1">' . round($contents->list[$i + 1]->main->temp) . " " . $currentunit .'</div>
                                        <div class="row row2"><img class="img-fluid img-thumbnail" src="http://openweathermap.org/img/wn/' . $contents->list[$i + 1]->weather[0]->icon . '@2x.png"/></div>
                                        <div class="row row3">' . substr($contents->list[$i + 1]->dt_txt, 11, 5) . '</div>
                                        <div class="row row4">' . $contents->list[$i + 1]->weather[0]->description . '</div>
                                    </div>
                                    <div class="col d-block w-100">
                                        <div class="row row1">' . round($contents->list[$i + 2]->main->temp) . " " . $currentunit .'</div>
                                        <div class="row row2"><img class="img-fluid img-thumbnail" src="http://openweathermap.org/img/wn/' . $contents->list[$i + 2]->weather[0]->icon . '@2x.png"/></div>
                                        <div class="row row3">' . substr($contents->list[$i + 2]->dt_txt, 11, 5) . '</div>
                                        <div class="row row4">' . $contents->list[$i + 2]->weather[0]->description . '</div>
                                    </div>
                                


                            </div>
                    </div>';
            } ?>
        </div>

    </div>
    <button class="carousel-control-prev carousel-dark w-5" type="button" data-bs-target="#forecast" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Előző</span>
    </button>
    <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#forecast" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Következő</span>
    </button>


</div>