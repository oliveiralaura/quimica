<?php
require_once '../../startup/connectBD.php';

// Ativar relatórios de erro para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo 'oi'; // Para depuração

// Uncomment and fix session handling as necessary
// session_start();
// if (!isset($_SESSION['email']) || ($_SESSION['user_level'] !== 'admin' && $_SESSION['user_level'] !== 'master')) {
//     header('Location: ../../login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Atualizar referências na tabela `compostos` para NULL
        $sql_update = "UPDATE compostos SET criado_por = NULL WHERE id = ?";
        $stmt_update = $mysqli->prepare($sql_update);

        if ($stmt_update === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_update->bind_param('i', $id);

        if (!$stmt_update->execute()) {
            echo 'Erro ao atualizar referências: ' . htmlspecialchars($stmt_update->error);
            $stmt_update->close();
            $mysqli->close();
            exit();
        }

        $stmt_update->close();

        $sql_delete = "DELETE FROM usuarios WHERE id = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);

        if ($stmt_delete === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_delete->bind_param('i', $id);

        if ($stmt_delete->execute()) {
            header("Location: ../../adminFront/listCadastros/list_users.php?message=Usuário deletado com sucesso!");
            exit();
        } else {
            echo 'Erro ao deletar procedimento: ' . htmlspecialchars($stmt_delete->error);
        }

        $stmt_delete->close();
    } else {
        echo 'ID não definido na solicitação POST';
    }
} else {
    echo 'Método de solicitação inválido';
    header("Location: ../../adminFront/listCadastros/list_users.php?message=Método de solicitação inválido");
    exit();
}

$mysqli->close();
?>
