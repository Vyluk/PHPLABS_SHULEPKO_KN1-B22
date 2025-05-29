<?php
$intNumber = 10;           // ціле число
$floatNumber = 5.75;       // число з плаваючою точкою

// Явне перетворення типів
$intToFloat = (float)$intNumber;
$floatToInt = (int)$floatNumber;

echo "Ціле число: $intNumber<br>";
echo "Після перетворення у float: $intToFloat<br>";
echo "Дробове число: $floatNumber<br>";
echo "Після перетворення у int: $floatToInt<br>";
?>
