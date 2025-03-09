<?php
function validateTitle($title)
{
  if (empty($title)) {

    die("Este campo no puede estar vacio");
  };

  $title = trim($title);

  if (strlen($title) < 2 || strlen($title) > 30) {

    die("El nombre del anime debe tener entre 2 y 30 caracteres.");
  };


  $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);

  return $title;
}

function validateUrl($image_url)
{
  if (empty($image_url)) {
    die("La URL de la imagen no puede estar vacía");
  };

  $image_url = trim($image_url);

  if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
    die("La URL de la imagen no es válida");
  };

  $image_url = filter_var($image_url, FILTER_SANITIZE_URL);

  return $image_url;
}
