<?php
session_start();
header("Content-type: text/css; charset: UTF-8");

if (empty($_SESSION["bgsrc"])) $background = "images/cloudy.jpg";
else {
    switch ($_SESSION["bgsrc"]) {
        case 'tiszta égbolt':
            $background = "images/clear.jpg";
            break;

        case 'esős':
            $background = "images/rain.jpg";
            break;

        case 'havazás':
            $background = "images/snow.jpg";
            break;

        case 'köd':
            $background = "images/mist.jpg";
            break;

        case 'villám':
            $background = "images/thunderstorm.jpg";
            break;

        default:
            $background = "images/cloudy.jpg";
            break;
    }
}
$darken=100;
if(!empty($_SESSION["dorn"]) ) {
    if($_SESSION["dorn"] == 'n') {
        $darken=50;
    }    
}
session_destroy();
?>

body {
background: url("<?php echo $background; ?>") no-repeat;
background-attachment: fixed;
backdrop-filter: brightness(<?php echo $darken; ?>%);
}
