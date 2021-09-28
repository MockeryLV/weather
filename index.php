<?php

require_once 'vendor/autoload.php';
require_once 'CityList.php';
require_once 'Models/Weather.php';
require_once 'Initializer.php';

//$cityList = new CityList('cities.csv'); wanted to use csv file for city list but smh went wrong and I had 1+ minute csv file loading after hit refresh

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>

    <div>
        <form action="#" method="get">
            <select name="city">
                <option disabled>Choose City</option>
                <option value="Riga">Riga</option>
                <option value="Jelgava">Jelgava</option>
                <option value="London">London</option>
                <option value="Moscow">Moscow</option>
                <option value="Mexico">Mexico</option>
                <option value="Toronto">Toronto</option>
            </select>
            <input type="submit">
        </form>

        <?php

$city = 'Riga';

if(isset($_GET['city'])){


    $city = $_GET['city'];
}
    $days = 3;
    $hours = 8;
    $hoursCounter = 0;

    $xml = json_decode(file_get_contents("http://api.weatherapi.com/v1/forecast.json?key=6053615a3dd2405783875300212809&q={$city}&days={$days}&aqi=no&alerts=no"));

    $location = $xml->location->name;

    $currentTime = explode(':', explode(' ', $xml->location->localtime)[1])[0];

    $initializer = new Initializer($xml->forecast->forecastday);

?>


    </div>

    <h1 align="center"> <?= $location ?></h1>
    <h2 align="center"><?=explode(' ', $xml->location->localtime)[1]?></h2>
    <div class="container">
        <div class="line">
        <?php foreach ($initializer->getForecast() as $item): ?>
            <div class="block">
                <img src="<?= $item->getIcon()?>" alt="">
                <h5>
                <?= $item->getCondition() ?>
                </h5>
                <?= $item->getDay() ?>
                <br>
                <?=$item->getAvgTemp(). '°C' ?>
                <br>
                <?= 'Lowest temp: ' . $item->getLTemp() . '°C'?>
                <br>

            </div>
        <?php endforeach;?>
        </div>
    </div>
    <br>
    <br>

    <h2 align="center">Today</h2>
    <div class="container">
        <?php foreach ($initializer->getForecast()[0]->getHours() as $item): ?>
        <?php if($currentTime <= (int) explode(':',explode(' ',$item->time)[1])[0] && $hoursCounter < $hours):?>
        <div class="block">

            <img src="<?= $item->condition->icon ?>">
            <h5>
                <?= $item->condition->text ?>
            </h5>
            <?= explode(' ',$item->time)[1] ?>
            <br>
            <br>
            <?= $item->temp_c. '°C' ?>
        </div>
            <?php $hoursCounter++; ?>
        <?php endif;?>
        <?php endforeach;?>
        <?php $hoursCounter = 0; ?>
    </div>

</body>
</html>
