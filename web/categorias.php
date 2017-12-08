<html>
<head>
    <title>Supermercado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Supermercado</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="categorias.php">Categorias</a></li>
            <li><a href="reposicao.php">Reposicoes</a></li>
        </ul>
    </div>
</nav>
<div class="page-header" align="center">
    <h1>Supermercado</h1>
    <h2>Categorias</h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <form action="adicionarCategoria.php" method="post">
                <div class="form-group">
                    <label for="nome">Categoria</label>
                    <input type="text" class="form-control" name="nome" placeholder="Categoria">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Adicionar</button>
            </form>
        </div>
        <div class="col-md-4 text-center">
            <form action="adicionarSubCategoria.php" method="post">
                <div class="form-group">
                    <label for="superCategoria">Super Categoria</label>
                    <input type="text" class="form-control" name="superCategoria" placeholder="Super categoria">
                </div>
                <div class="form-group">
                    <label for="subCategoria">Nova sub-categoria</label>
                    <input type="text" class="form-control" name="subCategoria" placeholder="Sub-categoria">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Adicionar</button>
            </form>
        </div>
        <div class="col-md-4 text-center">
            <form action="apagarCategoria.php" method="post">
                <div class="form-group">
                    <label for="nome">Categoria</label>
                    <input type="text" class="form-control" name="nome" placeholder="Categoria a apagar">
                </div>
                <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once "config.php";

function hasChild($db, $nome)
{
    return $db->query("SELECT * FROM constituida WHERE super_categoria='{$nome}'")->rowCount() > 0;
}

function makeFullItemString($count)
{
    $stringBuilder = "item-";
    foreach ($count as $item) {
        $stringBuilder .= $item . "-";
    }

    return $stringBuilder;
}

function makeLastItemString($count)
{
    $stringBuilder = "item-";
    $elements = count($count);
    foreach ($count as $item) {
        if (--$elements <= 0) {
            break;
        }
        $stringBuilder .= $item . "-";
    }

    return $stringBuilder;
}

function renderSubTable($db, $nomeCategoria, $count)
{
    $sql = "SELECT * FROM constituida WHERE super_categoria='{$nomeCategoria}'";
    $result = $db->query($sql);
    array_push($count, 1);
    ?>
    <div class="list-group collapse" id="<?php echo makeLastItemString($count) ?>">
        <?php
        foreach ($result

                 as $categoria) {
            ?>
                <a href="#<?php echo makeFullItemString($count) ?>"
                   class="list-group-item" <?php if (hasChild($db, $categoria['categoria'])) {
                    echo "data-toggle='collapse'";
                } ?>>
                    <?php if (hasChild($db, $categoria['categoria'])) {
                        echo "<i class='glyphicon glyphicon-chevron-right'></i>";
                    }
                    echo $categoria['categoria']; ?>
                </a>
            <?php

            if (hasChild($db, $categoria['categoria'])) {
                renderSubTable($db, $categoria['categoria'], $count);
            }

            $count[count($count) - 1]++;
        }
        ?>
    </div>
    <?php
}

try {
$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM categoria WHERE nome NOT IN (SELECT categoria FROM constituida)";
$result = $db->query($sql);
$count = array(1);
$hasChild = false;
?>
<div class="just-padding">
    <div class="list-group list-group-root well">
        <?php
        foreach ($result

                 as $categoria) {
            ?>
                <a href="#<?php echo makeFullItemString($count) ?>"
                   class="list-group-item" <?php if (hasChild($db, $categoria['nome'])) {
                    echo "data-toggle='collapse'";
                } ?>>
                    <?php if (hasChild($db, $categoria['nome'])) {
                        echo "<i class='glyphicon glyphicon-chevron-right'></i>";
                    }
                    echo $categoria['nome']; ?>
                </a>
            <?php
            renderSubTable($db, $categoria['nome'], $count);
            $count[0]++;
        }
        $db = null;
        } catch (PDOException $e) {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="custom.js"></script>
</body>
</html>
