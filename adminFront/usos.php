<?php
  require_once '../startup/connectBD.php';
  session_start();


if (!isset($_SESSION['email']) || ($_SESSION['tipo'] !== 'admin' )) {
    header('Location: http://localhost:3000/');
    exit();
}

  // Carregar compostos do banco de dados
  $sql_compos = "SELECT id, nome FROM compostos;";
  $result_compos = $mysqli->query($sql_compos);

  if ($result_compos->num_rows > 0) {
      while ($composto = $result_compos->fetch_assoc()) {
          $dados_compos[] = array(
              'id' => $composto['id'],
              'nome' => $composto['nome']
          );
      }
  } else {
      echo 'Nenhum registro de composto encontrado';
      exit;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Usos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="listCadastros/list_usos.php">Voltar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <form action="../adminBack/cadastro/cadastra_uso.php" method="post" class="container mt-5">
      <div class="mb-3">
        <label for="composto" class="form-label">Composto</label>
        <select class="form-select form-select mb-3" aria-label="Large select example" id="composto" name="composto_id" required>
          <option selected disabled>Escolha um composto</option>
          <?php foreach ($dados_compos as $composto): ?>
            <option value="<?php echo $composto['id']; ?>"><?php echo $composto['nome']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="uso" class="form-label">Descrição do Uso</label>
        <textarea class="form-control" id="uso" name="uso_descricao" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
