<?php
function celsiusToFahrenheit($celsius) {
    return $celsius * 9 / 5 + 32;
}

// Тест: конвертація 25°C
$tempC = 25;
$tempF = celsiusToFahrenheit($tempC);

echo "$tempC градусів Цельсія дорівнює $tempF градусів Фаренгейта.";
?>
