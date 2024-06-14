<?php
// edit_composto.php
include '../../startup/connectBD.php';

// if (!isset($_SESSION['email']) || $_SESSION['user_level'] !== 'admin' && $_SESSION['user_level'] !== 'master') {
//     header('Location: ../../login.php');
//     exit();
// }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM compostos WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $composto = $result->fetch_assoc();
}

$sql_grupos_funcionais = "SELECT * FROM grupos_funcionais";
$result_grupos_funcionais = $mysqli->query($sql_grupos_funcionais);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Composto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Composto</h2>
        <form action="../../adminBack/update/update_composto.php" method="post">
            <input type="hidden" name="id" value="<?php echo $composto['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Composto</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $composto['nome']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="formula_molecular" class="form-label">Fórmula Molecular</label>
                <input type="text" class="form-control" id="formula_molecular" name="formula_molecular" value="<?php echo $composto['formula_molecular']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="estrutura_molecular" class="form-label">Estrutura Molecular</label>
                <input type="text" class="form-control" id="estrutura_molecular" name="estrutura_molecular" value="<?php echo $composto['estrutura_molecular']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="grupo_funcional_id" class="form-label">Grupo Funcional</label>
                <select class="form-control" id="grupo_funcional_id" name="grupo_funcional_id" required>
                    <?php while ($grupo_funcional = $result_grupos_funcionais->fetch_assoc()): ?>
                        <option value="<?php echo $grupo_funcional['id']; ?>" <?php if ($grupo_funcional['id'] == $composto['grupo_funcional_id']) echo 'selected'; ?>>
                            <?php echo $grupo_funcional['nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
