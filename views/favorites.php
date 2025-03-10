<?php
include('../config/connect.php');

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $query = "SELECT favorite FROM animes WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $favorite);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  $newState = $favorite ? 0 : 1;

  $updateQuery = "UPDATE animes SET favorite = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $updateQuery);
  mysqli_stmt_bind_param($stmt, "ii", $newState, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  mysqli_close($conn);

  header("Location: index.php");
  exit();
} else {
  header("Location: index.php");
  exit();
}
