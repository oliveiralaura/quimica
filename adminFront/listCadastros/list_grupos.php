<?php
require_once '../../startup/connectBD.php';
session_start();


if (!isset($_SESSION['email']) || ($_SESSION['tipo'] !== 'admin' )) {
    header('Location: http://localhost:3000/');
    exit();
}
$sql_grupos = "SELECT * FROM `grupos_funcionais`";
$result_grupos = $mysqli->query($sql_grupos);

if (mysqli_num_rows($result_grupos) > 0) {
    while ($user = mysqli_fetch_array($result_grupos)) {
        $dados_profissa[] = array(
            'id' => $user['id'],
            'nome' => $user['nome'],
            'descricao' => $user['descricao'],
        );
    }
} else {
    echo 'Nenhum registro de usuários';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de profissionais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        header {
            /* Adicione seu estilo aqui, se necessário */
        }
        main {
            width: 100%;
            min-height: 500px;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="card">
            <div class="card-header">
                Olá, seja bem-vindo(a)
            </div>
            <div class="card-body">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../../total.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="list_composto.php">Compostos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="list_grupos.php">Grupos Funcionais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="list_propriedade.php">Propriedades</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="list_usos.php">Usos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="list_users.php">Usúarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="http://localhost:3000/">Site</a>
                                </li>
                                
                                <li class="nav-item">
                                <a class="nav-link active" aria-disabled="true" href="../../adminBack/sair.php">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <a class="nav-link active" aria-current="page" href="../grupo_funcional.php">Cadastrar Grupo Funcional</a>
            </div>
        </div>
    </header>
    <main class="container">
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_GET['message']; ?>
            </div>
        <?php endif; ?>

        <div class="row mt-4 rounded m-2 p-2 d-flex border">
            <div class="col">ID</div>
            <div class="col">Nome </div>
            <div class="col">Descrição</div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
        <?php if (!empty($dados_profissa)): ?>
            <?php foreach($dados_profissa as $retorno): ?>
                <div class="row mt-4 rounded m-2 p-2 d-flex border">
                    <div class="col"><?php echo $retorno['id']; ?></div>
                    <div class="col"><?php echo $retorno['nome']; ?></div>
                    <div class="col"><?php echo $retorno['descricao']; ?></div>
                    <div class="col">
                        <a href="../edit/edit_grupos.php?id=<?php echo $retorno['id']; ?>" class="btn btn-success">Update</a>
                    </div>

                    <div class="col">
                        <form action="../../adminBack/delete/delete_grupos.php" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
                            <input type="hidden" name="id" value="<?php echo $retorno['id']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>