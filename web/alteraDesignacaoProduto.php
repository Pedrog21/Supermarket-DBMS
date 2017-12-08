<?php
  include_once "config.php";
  try {
    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE produto SET design='{$_POST["nova_designacao"]}' WHERE ean='{$_POST["ean"]}'";
    $result=$db->query($sql);
    $db = null;
    header('Location: produtos.php');
  }
  catch(PDOException $e)
  {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
    ?>
