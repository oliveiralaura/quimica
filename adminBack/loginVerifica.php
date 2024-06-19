<?php
session_start();
require_once '../startup/connectBD.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$mens = '';

if (!empty($email) && !empty($senha)) {
    $query = "SELECT * FROM usuarios WHERE email=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $tipo = $row['tipo'];
        $senha_hash = $row['senha'];

        // Verificar a senha usando password_verify()
        if (password_verify($senha, $senha_hash)) {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;  // Salvar o ID do usuário na sessão
            $_SESSION['tipo'] = $tipo;

            if ($tipo === 'admin') {
                header("Location: http://localhost/quimicaOrganica/total.php");
                exit();
            } else {
                $mens = "Entrada permitida apenas para administradores";
            }
        } else {
            $mens = "Email ou senha incorretos.";
        }
    } else {
        $mens = "Email ou senha incorretos.";
    }
} else {
    $mens = "Por favor, preencha todos os campos.";
}

$_SESSION['status_response'] = array('mens' => $mens);

// Redirecionamento com a mensagem de erro
header("Location: http://localhost:3000/");
exit();
?>
