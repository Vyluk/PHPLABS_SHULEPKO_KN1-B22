<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Факторіал числа</title>
</head>
<body>
    <h2>Обчислення факторіала</h2>

    <form method="get">
        <label for="number">Введіть число:</label>
        <input type="number" name="number" id="number" min="0" required>
        <button type="submit">Обчислити</button>
    </form>

    <?php
    if (isset($_GET['number'])) {
        $n = (int)$_GET['number'];
        $factorial = 1;

        for ($i = 1; $i <= $n; $i++) {
            $factorial *= $i;
        }

        echo "<p>Факторіал числа $n дорівнює $factorial.</p>";
    }
    ?>
</body>
</html>
