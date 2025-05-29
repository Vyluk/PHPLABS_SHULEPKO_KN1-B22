<?php
echo date("d-m-Y");
?>

<?php
$year = 2024;

if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "Рік $year є високосним.";
} else {
    echo "Рік $year не є високосним.";
}
?>
