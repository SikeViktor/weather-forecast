<?php
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST["cityName"]) && !empty($_POST["cityName"])) {

    if (isset($_POST["unit"])) {
        switch ($_POST["unit"]) {
            case 'celsius':
                $unit = "metric";
                break;
            case 'fahrenheit':
                $unit = "imperial";
                break;
            case 'kelvin':
                $unit = "standard";
                break;
        }
    }

    $cityName = $_POST["cityName"];
    $appid = "6678d46ccc3f1fb002695546252c1466";
    $url = "http://api.openweathermap.org/data/2.5/forecast?appid=" . $appid . "&q=" . $cityName . "&units=" . $unit . "&lang=hu";

    $contents = json_decode(file_get_contents($url));

    if(empty($contents)) {        
        exit('<p class="bg-danger text-white col-8 offset-2">A beírt város időjárását nem sikerült lekérni!</p>');        
    }

    $icon = $contents->list[0]->weather[0]->icon;
    $current_temp = round($contents->list[0]->main->temp);
    $feels_like = $contents->list[0]->main->feels_like;
    $temp_min = $contents->list[0]->main->temp_min;
    $temp_max = $contents->list[0]->main->temp_max;
    $humidity = $contents->list[0]->main->humidity;

    $main = $contents->list[0]->weather[0]->main;
    $description = $contents->list[0]->weather[0]->description;

    $clouds = $contents->list[0]->clouds->all; //%

    $wind = $contents->list[0]->wind->speed*3.6; //m/s  

    $country = $contents->city->country;

    $sunrise = $contents->city->sunrise;
    $sunset = $contents->city->sunset;

    $_SESSION["bgsrc"] = $description;

    $_SESSION["dorn"] = $contents->list[0]->sys->pod;

    include 'result.php';

    /*$json_pretty = json_encode($contents, JSON_PRETTY_PRINT);
        echo "<pre>" . $json_pretty . "<pre/>";*/
}
