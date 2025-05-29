<?php
$conn = new mysqli("localhost", "root", "", "Library");
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

$today = date("Y-m-d");
$lastMonth = date("Y-m-d", strtotime("-1 month"));

$sql = "SELECT * FROM Members WHERE membership_date >= '$lastMonth'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Нові члени бібліотеки</title>
</head>
<body>
    <h2>Члени, зареєстровані за останній місяць</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><?= $row["member_name"] ?> — <?= $row["email"] ?> (<?= $row["membership_date"] ?>)</li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Немає нових членів за останній місяць.</p>
    <?php endif; ?>
</body>
</html>
