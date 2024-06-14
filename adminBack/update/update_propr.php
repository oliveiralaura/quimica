<?php
include '../../startup/connectBD.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $composto = $_POST['composto_id'];

    $query = "UPDATE propriedades SET composto_id= ?, propriedade_nome=?, propriedade_valor=? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$composto,$nome,$valor, $id]);

    header("Location: ../../adminFront/listCadastros/list_propriedade.php?message=Propriedade atualizado com sucesso!");
    exit;
}
?>