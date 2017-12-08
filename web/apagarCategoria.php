<?php
  include_once "config.php";
  try {
    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM categoria WHERE nome='{$_POST['nome']}' OR nome IN (SELECT categoria FROM constituida WHERE super_categoria='{$_POST['nome']}')";
    $result = $db->query($sql);
    $db = null;

    header('Location: categorias.php');
  }
  catch (PDOException $e)
  {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
