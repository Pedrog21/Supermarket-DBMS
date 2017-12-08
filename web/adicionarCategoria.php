<?php
  include_once "config.php";

  try {
    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO categoria VALUES ('{$_POST['nome']}')";
    $sql2 = "INSERT INTO categoria_simples VALUES ('{$_POST['nome']}')";
    $result = $db->query($sql);
    $result2 = $db->query($sql2);
    $db = null;

    header('Location: categorias.php');
  }
  catch (PDOException $e)
  {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
