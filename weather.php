<?php
//Tạo các biến chứa dữ liệu của API_KEY và zipcode
$apiKey = "9d3d49d7940b60c61fc4cf7d8d41fe14";
$cityZip= '94040';
//kiểm tra biến zip đã tồn tại chưa. Nếu tồn tại thì gán nó cho $cityZip
if(isset($_POST['zip'])){
    $cityZip = $_POST['zip'];
}
//API Url
$googleApiUrl = "api.openweathermap.org/data/2.5/weather?zip=" . $cityZip ."&lang=en&units=metric&APPID=" . $apiKey;
//tạo mới một curl
$ch = curl_init();
//Cấu hình cho curl
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//Thực thi curl
$response = curl_exec($ch);
//Ngắt curl
curl_close($ch);
//Dữ liệu thời tiết ở dạng JSON
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
    <!-- Form nhập zipcode  -->
    <form class="input-zip" action="" method="POST">
        <input class="zip"  type="text" name="zip" placeholder="input your zip code" value="<?php echo $cityZip ?>"><br>
        <input type="submit" value="Check">
    </form>     
    <!-- Data lấy từ API được hiển thị -->
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


