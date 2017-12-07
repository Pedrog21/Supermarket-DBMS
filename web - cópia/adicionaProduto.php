<?php
  include_once "config.php";
  try {

    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO produto VALUES ('{$_POST['ean']}','{$_POST['design']}','{$_POST['categoria']}','{$_POST['forn_primario']}','{$_POST['data']}')";
    $result = $db->query($sql);


      if( isset($_POST['forn_sec']) )
      {
          foreach($_POST['forn_sec'] as $forn) {
              $db->query("INSERT INTO fornece_sec VALUES('{$forn}', '{$_POST['ean']}')");
          }
      }


      $db = null;
    header('Location: produtos.php');
  }
  catch (PDOException $e)
  {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
