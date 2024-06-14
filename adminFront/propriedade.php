<?php
  require_once '../startup/connectBD.php';
  session_start();


  if (!isset($_SESSION['email']) || ($_SESSION['tipo'] !== 'admin' )) {
      header('Location: http://localhost:3000/');
      exit();
  }
  $sql_prop = "SELECT * from compostos;";
  $result_prop = $mysqli->query($sql_prop);

  if (mysqli_num_rows($result_prop) > 0) {
      while ($user = mysqli_fetch_array($result_prop)) {
          $dados_prop[] = array(
              'id' => $user['id'],
              'nome' => $user['nome']
          );
      }
  } else {
      echo 'Nenhum registro de composto';
      exit;
  }


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadatsro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body><nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="listCadastros/list_propriedades.php">Voltar</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>
    <form action="../adminBack/cadastro/cadastra_prop.php" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome da propriedade</label>
            <input type="text" class="form-control" id="nome" aria-describedby="emailHelp" name="nome">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Valor da propriedade</label>
            <input type="text" class="form-control" id="valor" aria-describedby="emailHelp" name="valor">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Composto</label>
            <select class="form-select form-select mb-3" aria-label="Large select example" id="composto" name="composto">
              <option selected disabled>Escolha uma opção</option>
            <?php foreach ($dados_prop as $retorno): ?>
              <option value="<?php echo $retorno['id']; ?>"><?php echo $retorno['nome']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Cadastro</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>