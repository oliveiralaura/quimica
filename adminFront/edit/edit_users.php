<?php
// edit_profissa.php
include '../../startup/connectBD.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Preparar a declaração
    $query = "SELECT * FROM usuarios WHERE id = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $grupos = $result->fetch_assoc();
        } else {
            echo 'Usuario não encontrado.';
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
        <form action="../../adminBack/update/update_users.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($grupos['id']); ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome </label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($grupos['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($grupos['email']); ?>" required>
            </div>
            
            <div class="mb-3">
    <label for="tipo" class="form-label">Tipo:</label>
    <select class="form-control" id="tipo" name="tipo" required>
        <option value="admin" <?php echo ($grupos['tipo'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="usuario" <?php echo ($grupos['tipo'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
        <option selected disabled>Selecione um tipo</option>
    </select>
</div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>