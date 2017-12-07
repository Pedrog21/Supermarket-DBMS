<?php
include_once "config.php";

try {

    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = "SELECT * FROM categoria_simples WHERE nome='{$_POST['superCategoria']}'";
    $result1 = $db->query($sql1);
    if ($result1->rowCount() != 0) {
        $sql2 = "DELETE FROM categoria_simples WHERE nome='{$_POST['superCategoria']}'";
        $result2 = $db->query($sql2);
        $sql3 = "INSERT INTO super_categoria VALUES('{$_POST['superCategoria']}')";
        $result3 = $db->query($sql3);
    }
    $sql4 = "INSERT INTO categoria VALUES('{$_POST['subCategoria']}')";
    $result4 = $db->query($sql4);
    $sql5 = "INSERT INTO categoria_simples VALUES('{$_POST['subCategoria']}')";
    $result5 = $db->query($sql5);
    $sql6 = "INSERT INTO constituida VALUES('{$_POST['superCategoria']}', '{$_POST['subCategoria']}')";
    $result6 = $db->query($sql6);
    $db = null;

    header('Location: categorias.php');

} catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
}
?>
