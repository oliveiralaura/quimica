<?php
// edit_profissa.php
include '../../startup/connectBD.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Preparar a declaração
    $query = "SELECT * FROM grupos_funcionais WHERE id = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $grupos = $result->fetch_assoc();
        } else {
            echo 'Grupo não encontrado.';
            exit();
        }

        $stmt->close();
    } else {
        echo 'Erro ao preparar a consulta.';
        exit();
    }
} else {
    echo 'ID inválido.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Grupos Funcionais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Grupos Funcionais</h2>
        <form action="../../adminBack/update/update_grupos.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($grupos['id']); ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome </label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($grupos['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo htmlspecialchars($grupos['descricao']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>