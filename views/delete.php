<?php
include('../config/connect.php');

if (isset($_GET["id"])) {
  $id = intval($_GET["id"]);

  $sql = "DELETE FROM animes WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }

  mysqli_close($conn);
  header("Location: index.php");
  exit();
} else {
  header("Location: index.php");
  exit();
}
