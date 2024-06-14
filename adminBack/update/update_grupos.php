<?php
// update_profissa.php
include '../../startup/connectBD.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $query = "UPDATE grupos_funcionais SET nome= ?, descricao=? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$nome,$descricao, $id]);

    header("Location: ../../adminFront/listCadastros/list_grupos.php?message=Grupo atualizado com sucesso!");
    exit;
}
?>