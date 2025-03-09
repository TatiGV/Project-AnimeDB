<?php
include '../config/connect.php';
require("./validate.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = isset($_POST['title']) ? validateTitle($_POST['title']) : '';
  $image_url = isset($_POST['image']) ? validateUrl($_POST['image']) : '';

  if (!empty($title) && !empty($image_url)) {
    $sql = "INSERT INTO animes (title, image) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $title, $image_url);

    if (mysqli_stmt_execute($stmt)) {
      echo "Anime agregado correctamente.";
    } else {
      echo "Error al agregar anime: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
  } else {
    echo "Algunos campos están vacíos.";
  }
}

mysqli_close($conn);
