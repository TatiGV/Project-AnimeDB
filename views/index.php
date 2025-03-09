<?php
include '../config/connect.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = isset($_POST['title']) ? trim($_POST['title']) : '';
  $image_url = isset($_POST['image']) ? trim($_POST['image']) : '';

  if (!empty($title) && !empty($image_url)) {
    $sql = "INSERT INTO animes (title, image) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $title, $image_url);

    if (mysqli_stmt_execute($stmt)) {
      header("Location: index.php");
      exit();
    } else {
      $error = "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
  } else {
    $error = "Algunos campos están vacíos.";
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AnimeDB</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>

<body>

  <div class="container">
    <h1>Animes</h1>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form action="index.php" method="POST">
      <input maxlength="40" type="text" id="title" name="title" placeholder="Nombre del Anime" required>
      <input type="text" id="image" name="image" placeholder="URL de la Imagen" required>
      <button type="submit">Agregar Anime</button>
    </form>

    <h2>Lista de Animes</h2>
    <div class="anime-list">
      <?php
      include("../config/connect.php");
      $sql = "SELECT * FROM animes ORDER BY id DESC";
      $results = mysqli_query($conn, $sql);

      echo "<ul>";

      while ($anime = mysqli_fetch_assoc($results)) {
        $favoriteIcon = $anime['favorite'] ? '💖' : '🤍';

        echo "<li key='{$anime['id']}'  class='anime-card'>";
        echo "<img src='" . htmlspecialchars($anime['image']) . "' alt='" . htmlspecialchars($anime['title']) . "'>";
        echo "<p class='title'>" . htmlspecialchars($anime['title']) . "</p>";
        echo "<div class='buttons'>";
        echo "<a href='update.php?id=" . $anime['id'] . "' class='edit'>✏️</a>";
        echo "<a href='favorites.php?id=" . $anime['id'] . "' class='favorite'>" . $favoriteIcon . "</a>";
        echo "<a href='delete.php?id=" . $anime['id'] . "' class='delete'>🗑️</a>";
        echo "</div>";
        echo "</li>";
      }

      echo "</ul>";

      mysqli_close($conn);
      ?>
    </div>
  </div>

</body>

</html>