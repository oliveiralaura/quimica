<?php
require_once '../../startup/connectBD.php';

$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

if (!empty($nome)) {
    $query = "INSERT INTO `usuarios`(`id`, `nome`, `email`, `senha`) VALUES (null, '$nome', '$email', '$senha_hash')";

    if ($mysqli->query($query)) {
        header("Location: ../../adminFront/listCadastros/list_users.php");
    } else {
        echo "Erro ao inserir registro: " . $mysqli->error;
    }
} else {
    echo 'Nada digitado';
}
?>
