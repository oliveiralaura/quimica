<?php
include '../../startup/connectBD.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    $query = "UPDATE usuarios SET nome= ?, email=?, tipo=? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$nome,$email,$tipo, $id]);

    header("Location: ../../adminFront/listCadastros/list_users.php?message=Usúario atualizado com sucesso!");
    exit;
}
?>