<?php
$apiKey = "9d3d49d7940b60c61fc4cf7d8d41fe14";
$cityZip= '94040';
if(isset($_POST['zip'])){
    $cityZip = $_POST['zip'];
}
$googleApiUrl = "api.openweathermap.org/data/2.5/weather?zip=" . $cityZip ."&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>

<!doctype html>
<html>
<head>
    <title>Thông tin thời tiết</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <form class="input-zip" action="" method="POST">
        <input class="zip"  type="text" name="zip" placeholder="input your zip code" value="<?php echo $cityZip ?>"><br>
        <input type="submit" value="Check">
    </form>     
    
    <div class="report-container">
        <?php 
            if(!isset($data->name)){
                echo "<h2>Wrong ZipCode</h2>";
                die();
            }
        ?>
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>&deg;C
                <span
                class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>
</html>


