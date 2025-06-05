<?php
$conn = new mysqli("localhost", "root", "", "materials_db");
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

$sql = "
    SELECT c.name AS category, COUNT(m.id) AS total
    FROM categories c
    LEFT JOIN materials m ON c.id = m.category_id
    GROUP BY c.id
    ORDER BY total DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Звіт по категоріях</title>
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="adminlte/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper p-4">
    <div class="container">
      <h2 class="mb-4">Звіт: найпопулярніші категорії матеріалів</h2>

      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Категорія</th>
            <th>Кількість матеріалів</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= $row['total'] ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="2">Немає даних для відображення</td></tr>
          <?php endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
