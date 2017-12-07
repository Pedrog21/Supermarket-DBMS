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
      <h2>Reposicoes</h2>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-md-4">

          </div>
          <div class="col-md-4 text-center">
              <form action="listar_reposicao.php" method="post">
                  <div class="form-group">
                      <label for="ean">EAN</label>
                      <input type="text" class="form-control" name="ean" placeholder="EAN">
                  </div>
                  <button type="submit" name="submit" class="btn btn-success">Listar</button>
              </form>
          </div>
          <div class="col-md-4">

          </div>
      </div>
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

        $query = "SELECT * FROM reposicao";
        $result = $db->query($query);
      ?>
      <tr>
        <th>EAN</th>
        <th>Nro</th>
        <th>Lado</th>
        <th>Altura</th>
        <th>Operador</th>
        <th>Instante</th>
        <th>Unidades</th>
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
    ?>


</tbody>
  </table>
          </div>
      </div>
  </div>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
