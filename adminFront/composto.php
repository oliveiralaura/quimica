<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>
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
            <a class="nav-link active" aria-current="page" href="listCadastros/list_composto.php">Voltar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <form id="cadastroForm" action="../adminBack/cadastro/cadastra_composto.php" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $_SESSION['id']; ?>">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nome do composto</label>
      <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Formula molecular</label>
      <input type="text" class="form-control" id="formula" name="formula" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Estrutura molecular</label>
      <input type="text" class="form-control" id="estrutura" name="estrutura" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Imagem</label>
      <input type="file" class="form-control" id="imagem" name="imagem" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Grupo Funcional</label>
      <select class="form-select form-select mb-3" aria-label="Large select example" id="grupo" name="grupo" required>
        <option selected disabled>Escolha uma opção</option>
        <?php foreach ($dados_prop as $retorno): ?>
          <option value="<?php echo $retorno['id']; ?>"><?php echo $retorno['nome']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Cadastro</button>
  </form>
  <script>
    document.getElementById('cadastroForm').addEventListener('submit', function(event) {
      var nome = document.getElementById('nome').value.trim();
      var formula = document.getElementById('formula').value.trim();
      var estrutura = document.getElementById('estrutura').value.trim();
      var imagem = document.getElementById('imagem').value.trim();
      var grupo = document.getElementById('grupo').value;

      if (!nome || !formula || !estrutura || !imagem || grupo === 'Escolha uma opção') {
        alert('Por favor, preencha todos os campos.');
        event.preventDefault();
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
