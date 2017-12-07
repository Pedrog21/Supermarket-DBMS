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
      <h2>Produtos</h2>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-md-4 text-center">
            <form action="adiciona_produto.php" method="post">
                <div class="form-group">
                    <label for="ean" >EAN</label>
                    <input type="text" class="form-control" name="ean" placeholder="EAN">
                </div>
                <div class="form-group">
                    <label for="ean">Designacao</label>
                    <input type="text" class="form-control" name="design" placeholder="Designacao">
                </div>
                <div class="form-group">
                    <label for="ean">Categoria</label>
                    <input type="text" class="form-control" name="categoria" placeholder="Categoria">
                </div>
                <div class="form-group">
                    <label for="ean">Fornecedor Primario</label>
                    <input type="text" class="form-control" name="forn_primario" placeholder="NIF">
                </div>
                <div id="forn-sec-placeholder" class="form-group">
                    <label for="forn_sec[]">Fornecedor(es) Secundario(s)</label>
                </div>
                <button id="add-forn-sec" class="form-control" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>
                <div class="form-group">
                    <label for="ean">Data</label>
                    <input type="text" class="form-control" name="data" placeholder="Data">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Adicionar</button>
            </form>
          </div>
          <div class="col-md-4 text-center">
              <form action="altera_designacao_produto.php" method="post">
                  <div class="form-group">
                      <label for="ean">EAN</label>
                      <input type="text" class="form-control" name="ean" placeholder="EAN do Produto">
                  </div>
                  <div class="form-group">
                      <label for="nova_desigancao">Nova designacao</label>
                      <input type="text" class="form-control" name="nova_designacao" placeholder="Designacao do Produto">
                  </div>

                  <button type="submit" name="submit" class="btn btn-success">Alterar</button>
              </form>
          </div>
          <div class="col-md-4 text-center">
              <form action="apaga_produto.php" method="post">
                  <div class="form-group">
                      <label for="ean">EAN</label>
                      <input type="text" class="form-control" name="ean" placeholder="EAN">
                  </div>
                  <button type="submit" name="submit" class="btn btn-danger">Apagar</button>
              </form>
          </div>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
    <table class="table table-striped">

      <thead>
          <tr>
              <th>EAN</th>
              <th>Nome</th>
              <th>Categoria</th>
              <th>Fornecedor Primario</th>
              <th>Data</th>
          </tr>
      </thead>
        <tbody>
      <?php
        include_once "config.php";
        try {
          $db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql="SELECT * FROM produto";
          $result=$db->query($sql);

          foreach ($result as $produto) {
            echo("<tr>");
            echo("<td>{$produto['ean']}</td>");
            echo("<td>{$produto['design']}</td>");
            echo("<td>{$produto['categoria']}</td>");
            echo("<td>{$produto['forn_primario']}</td>");
            echo("<td>{$produto['data']}</td>");
            echo("</tr>");
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="custom.js"></script>
      </body>
      </html>
