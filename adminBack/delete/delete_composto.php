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

        // Deletar referências na tabela `propriedades`
        $sql_delete_propriedades = "DELETE FROM propriedades WHERE composto_id = ?";
        $stmt_delete_propriedades = $mysqli->prepare($sql_delete_propriedades);

        if ($stmt_delete_propriedades === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_delete_propriedades->bind_param('i', $id);

        if (!$stmt_delete_propriedades->execute()) {
            echo 'Erro ao deletar referências em propriedades: ' . htmlspecialchars($stmt_delete_propriedades->error);
            $stmt_delete_propriedades->close();
            $mysqli->close();
            exit();
        }

        $stmt_delete_propriedades->close();

        // Deletar referências na tabela `usos`
        $sql_delete_usos = "DELETE FROM usos WHERE composto_id = ?";
        $stmt_delete_usos = $mysqli->prepare($sql_delete_usos);

        if ($stmt_delete_usos === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_delete_usos->bind_param('i', $id);

        if (!$stmt_delete_usos->execute()) {
            echo 'Erro ao deletar referências em usos: ' . htmlspecialchars($stmt_delete_usos->error);
            $stmt_delete_usos->close();
            $mysqli->close();
            exit();
        }

        $stmt_delete_usos->close();

        // Deletar a entrada na tabela `compostos`
        $sql_delete = "DELETE FROM compostos WHERE id = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);

        if ($stmt_delete === false) {
            die('Erro na preparação: ' . htmlspecialchars($mysqli->error));
        }

        $stmt_delete->bind_param('i', $id);

        if ($stmt_delete->execute()) {
            header("Location: ../../adminFront/listCadastros/list_composto.php?message=Composto deletado com sucesso!");
            exit();
        } else {
            echo 'Erro ao deletar composto: ' . htmlspecialchars($stmt_delete->error);
        }

        $stmt_delete->close();
    } else {
        echo 'ID não definido na solicitação POST';
    }
} else {
    echo 'Método de solicitação inválido';
    header("Location: ../../adminFront/listCadastros/list_composto.php?message=Método de solicitação inválido");
    exit();
}

$mysqli->close();
?>
