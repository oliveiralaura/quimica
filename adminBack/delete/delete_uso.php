<?php
require_once '../../startup/connectBD.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// session_start();
// if (!isset($_SESSION['email']) || ($_SESSION['user_level'] !== 'admin' && $_SESSION['user_level'] !== 'master')) {
//     header('Location: ../../login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql_delete = "DELETE FROM usos WHERE id = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);

        if ($stmt_delete === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_delete->bind_param('i', $id);

        if ($stmt_delete->execute()) {
            header("Location: ../../adminFront/listCadastros/list_usos.php?message=Uso deletado com sucesso!");
            exit();
        } else {
            echo 'Erro ao deletar uso: ' . htmlspecialchars($stmt_delete->error);
        }

        $stmt_delete->close();
    } else {
        echo 'ID não definido na solicitação POST';
    }
} else {
    echo 'Método de solicitação inválido';
    header("Location: ../../adminFront/listCadastros/list_usos.php?message=Método de solicitação inválido");
    exit();
}

$mysqli->close();
?>
