<?php
$conn = new mysqli("localhost", "root", "", "materials_db");
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);

    // Автор
    if (!empty($_POST["new_author"])) {
        $new_author = $conn->real_escape_string($_POST["new_author"]);
        $conn->query("INSERT INTO authors (full_name) VALUES ('$new_author')");
        $author_id = $conn->insert_id;
    } else {
        $author_id = (int)$_POST["author_id"];
    }

    // Категорія
    if (!empty($_POST["new_category"])) {
        $new_category = $conn->real_escape_string($_POST["new_category"]);
        $conn->query("INSERT INTO categories (name) VALUES ('$new_category')");
        $category_id = $conn->insert_id;
    } else {
        $category_id = (int)$_POST["category_id"];
    }

    // Додавання матеріалу
    $sql = "INSERT INTO materials (title, content, author_id, category_id)
            VALUES ('$title', '$content', $author_id, $category_id)";
    $message = $conn->query($sql) ? "✅ Матеріал додано!" : "❌ Помилка: " . $conn->error;
}

// Витяг списків
$authors = $conn->query("SELECT * FROM authors");
$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Додати матеріал</title>
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="adminlte/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper p-4">
    <div class="container">
      <h2 class="mb-4">Додати навчальний матеріал</h2>

      <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="form-group">
          <label for="title">Назва</label>
          <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="content">Опис</label>
          <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>

        <div class="form-group">
          <label for="author_id">Автор (оберіть або введіть нове ім’я)</label>
          <select name="author_id" id="author_id" class="form-control">
            <option value="">-- Оберіть автора --</option>
            <?php while ($row = $authors->fetch_assoc()): ?>
              <option value="<?= $row['id'] ?>"><?= $row['full_name'] ?></option>
            <?php endwhile; ?>
          </select>
          <small class="form-text text-muted">Або введіть нового автора нижче:</small>
          <input type="text" name="new_author" class="form-control mt-1" placeholder="Новий автор">
        </div>

        <div class="form-group">
          <label for="category_id">Категорія (оберіть або введіть нову)</label>
          <select name="category_id" id="category_id" class="form-control">
            <option value="">-- Оберіть категорію --</option>
            <?php while ($row = $categories->fetch_assoc()): ?>
              <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
          </select>
          <small class="form-text text-muted">Або введіть нову категорію нижче:</small>
          <input type="text" name="new_category" class="form-control mt-1" placeholder="Нова категорія">
        </div>

        <button type="submit" class="btn btn-primary">Додати</button>
      </form>
    </div>
  </div>
</div>

<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
