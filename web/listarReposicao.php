<html>
  <head>
    <title>Supermercado</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
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
      <h2>Reposicao do produto</h2>
      <h3><?php echo $_POST['ean']?></h3>
  </div>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <table class="table table-striped">
                  <thead>

<?php
  include_once "config.php";

  try {
    $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM reposicao WHERE ean='{$_POST['ean']}'";
    $result=$db->query($sql);
    ?>
    <tr>
      <th>EAN</th>
      <th>Nro</th>
      <th>Lado</th>
      <th>Altura</th>
      <th>Operador</th>
      <th>Instante</th>
      <th>Unidade</th>
    </tr>
                  </thead>
                  <tbody>
    <?php
      foreach($result as $reposicao)
      {
        echo("<tr>");
        echo("<td>{$reposicao['ean']}</td>");
        echo("<td>{$reposicao['nro']}</td>");
        echo("<td>{$reposicao['lado']}</td>");
        echo("<td>{$reposicao['altura']}</td>");
        echo("<td>{$reposicao['operador']}</td>");
        echo("<td>{$reposicao['instante']}</td>");
        echo("<td>{$reposicao['unidades']}</td>");
        echo("</tr>");

      $db = null;
    }
  }
    catch (PDOException $e)
    {
      echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    $db = null;

?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <div class="text-center">
      <a href="reposicao.php"><button class="btn btn-primary">Voltar</button></a>
  </div>


</html>
