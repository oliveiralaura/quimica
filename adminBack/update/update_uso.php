<?php
include '../../startup/connectBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $composto_id = $_POST['composto_id'];
    $uso_descricao = $_POST['uso_descricao'];

    $query = "UPDATE usos SET composto_id=?, uso_descricao=? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('isi', $composto_id, $uso_descricao, $id);

    if ($stmt->execute()) {
        header("Location: ../../adminFront/listCadastros/list_usos.php?message=Uso atualizado com sucesso!");
        exit;
    } else {
        echo "Erro ao atualizar uso: " . $stmt->error;
    }
}
?>
