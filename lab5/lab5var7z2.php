<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Перевірка на великі літери</title>
</head>
<body>
    <h2>Перевірка тексту на великі літери</h2>

    <form method="post">
        <label for="text">Введіть текст:</label><br>
        <textarea name="text" id="text" rows="4" cols="40" required></textarea><br>
        <button type="submit">Перевірити</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $text = $_POST['text'];

        if (preg_match('/[A-ZА-Я]/u', $text)) {
            echo "<p>Текст містить хоча б одну велику літеру.</p>";
        } else {
            echo "<p>У тексті немає великих літер.</p>";
        }
    }
    ?>
</body>
</html>
