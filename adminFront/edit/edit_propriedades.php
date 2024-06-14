<?php
// edit_procede.php
include '../../startup/connectBD.php';

// if (!isset($_SESSION['email']) || $_SESSION['user_level'] !== 'admin' && $_SESSION['user_level'] !== 'master') {
//     header('Location: ../../login.php');
//     exit();
// }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM propr WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $propriedade = $result->fetch_assoc();
}

$sql_composto = "SELECT * FROM compostos";
$result_composto = $mysqli->query($sql_composto);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Propriedade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Propriedade</h2>
        <form action="../../adminBack/update/update_propr.php" method="post">
            <input type="hidden" name="id" value="<?php echo $propriedade['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Propriedade</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $propriedade['propriedade_nome']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $propriedade['propriedade_valor']; ?>" required>
            </div>
           
            <div class="mb-3">
                <label for="composto_id" class="form-label">Composto</label>
                <select class="form-control" id="composto_id" name="composto_id" required>
                    <?php while ($servico = $result_composto->fetch_assoc()): ?>
                        <option value="<?php echo $servico['id']; ?>" <?php if ($servico['id'] == $propriedade['nome']) echo 'selected'; ?>>
                            <?php echo $servico['nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>