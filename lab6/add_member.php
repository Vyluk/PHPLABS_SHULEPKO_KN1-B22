<?php
$conn = new mysqli("localhost", "root", "", "Library");
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $date = date("Y-m-d");

    // Перевірка унікальності email
    $check = $conn->query("SELECT * FROM Members WHERE email = '$email'");
    if ($check->num_rows > 0) {
        $message = "Користувач з таким email вже існує.";
    } else {
        $sql = "INSERT INTO Members (member_name, email, membership_date)
                VALUES ('$name', '$email', '$date')";
        if ($conn->query($sql) === TRUE) {
            $message = "Член бібліотеки доданий успішно!";
        } else {
            $message = "Помилка: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додавання члена бібліотеки</title>
</head>
<body>
    <h2>Форма додавання</h2>
    <form method="post">
        <label>Ім’я:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Додати</button>
    </form>

    <p><strong><?= $message ?></strong></p>
</body>
</html>
