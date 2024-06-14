<?php
include '../../startup/connectBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $formula_molecular = $_POST['formula_molecular'];
    $estrutura_molecular = $_POST['estrutura_molecular'];
    $grupo_funcional_id = $_POST['grupo_funcional_id'];
   

    $query = "UPDATE compostos SET nome=?, formula_molecular=?, estrutura_molecular=?, grupo_funcional_id=? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sssii', $nome, $formula_molecular, $estrutura_molecular, $grupo_funcional_id, $id);

    if ($stmt->execute()) {
        header("Location: ../../adminFront/listCadastros/list_composto.php?message=Composto atualizado com sucesso!");
        exit;
    } else {
        echo "Erro ao atualizar composto: " . $stmt->error;
    }
}
?>
