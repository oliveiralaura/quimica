<?php
include '../../startup/connectBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $formula_molecular = $_POST['formula_molecular'];
    $estrutura_molecular = $_POST['estrutura_molecular'];
    $grupo_funcional_id = $_POST['grupo_funcional_id'];
    
    // Handle image upload
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_nome = basename($_FILES['imagem']['name']);
        $imagem_dir = '../imagem/' . $imagem_nome;

        if (move_uploaded_file($imagem_tmp, $imagem_dir)) {
            $imagem = $imagem_nome;
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    }

    // Prepare SQL statement
    if (!empty($imagem)) {
        $query = "UPDATE compostos SET nome=?, formula_molecular=?, estrutura_molecular=?, images=?, grupo_funcional_id=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssii', $nome, $formula_molecular, $estrutura_molecular, $imagem, $grupo_funcional_id, $id);
    } else {
        $query = "UPDATE compostos SET nome=?, formula_molecular=?, estrutura_molecular=?, grupo_funcional_id=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssi', $nome, $formula_molecular, $estrutura_molecular, $grupo_funcional_id, $id);
    }

    // Execute query
    if ($stmt->execute()) {
        header("Location: ../../adminFront/listCadastros/list_composto.php?message=Composto atualizado com sucesso!");
        exit;
    } else {
        echo "Erro ao atualizar composto: " . $stmt->error;
    }
}
?>
