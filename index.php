<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once 'startup/connectBD.php';
$dados = array();

$sql = "SELECT * FROM compoe2";
$result = mysqli_query($mysqli, $sql);

if (!$result) {
    echo json_encode(['message' => 'Database query failed']);
    error_log('Database query failed: ' . mysqli_error($mysqli));
    exit;
}

if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_array($result)) {
        $dados[] = array(
            'id' => $user['id'],
            'nome' => $user['nome_composto'],
            'formula_molecular' => $user['formula_molecular'],
            'estrutura_molecular' => $user['estrutura_molecular'],
            'nome_grupo_funcional' => $user['nome_grupo_funcional'],
            'images' => $user['images'],
            'criado_em' => $user['criado_em']
        );
    }
} else {
    echo json_encode(['message' => 'Nenhum filme encontrado']);
    exit;
}

echo json_encode($dados);
?>
