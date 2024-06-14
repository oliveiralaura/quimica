<?php
// edit_uso.php
include '../../startup/connectBD.php';

// if (!isset($_SESSION['email']) || $_SESSION['user_level'] !== 'admin' && $_SESSION['user_level'] !== 'master') {
//     header('Location: ../../login.php');
//     exit();
// }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM usos WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $uso = $result->fetch_assoc();
}

$sql_composto = "SELECT * FROM compostos";
$result_composto = $mysqli->query($sql_composto);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Uso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Uso</h2>
        <form action="../../adminBack/update/update_uso.php" method="post">
            <input type="hidden" name="id" value="<?php echo $uso['id']; ?>">
            <div class="mb-3">
                <label for="uso_descricao" class="form-label">Descrição do Uso</label>
                <input type="text" class="form-control" id="uso_descricao" name="uso_descricao" value="<?php echo $uso['uso_descricao']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="composto_id" class="form-label">Composto</label>
                <select class="form-control" id="composto_id" name="composto_id" required>
                    <?php while ($composto = $result_composto->fetch_assoc()): ?>
                        <option value="<?php echo $composto['id']; ?>" <?php if ($composto['id'] == $uso['composto_id']) echo 'selected'; ?>>
                            <?php echo $composto['nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
