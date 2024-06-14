<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../startup/connectBD.php';

    function limpar_entrada($conexao, $dados) {
        $dados = htmlspecialchars($dados); // Evita XSS
        $dados = mysqli_real_escape_string($conexao, trim($dados)); // Evita SQL Injection
        return $dados;
    }

    $nome = limpar_entrada($mysqli, $_POST['nome']);
    $formula_molecular = limpar_entrada($mysqli, $_POST['formula']);
    $estrutura_molecular = limpar_entrada($mysqli, $_POST['estrutura']);
    $grupo_funcional_id = intval($_POST['grupo']); // Converte para inteiro
    $criado_por = limpar_entrada($mysqli, $_POST['user']);
    
    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_destino = '../imagem/' . $imagem_nome; // Especifique o diretório correto
        
        if (move_uploaded_file($imagem_temp, $imagem_destino)) {
            // Query para inserir no banco de dados
            $query = "INSERT INTO compostos (nome, formula_molecular, estrutura_molecular, images, grupo_funcional_id, criado_por, criado_em) 
                      VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $mysqli->prepare($query);
            
            $stmt->bind_param("ssssis", $nome, $formula_molecular, $estrutura_molecular, $imagem_nome, $grupo_funcional_id, $criado_por);
            
            if ($stmt->execute()) {
                header("Location: ../../adminFront/listCadastros/list_composto.php");
                exit();
            } else {
                echo "Erro ao inserir registro: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Erro ao mover o arquivo para o destino especificado.";
        }
    } else {
        if ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            echo "Erro no upload do arquivo de imagem: " . $_FILES['imagem']['error'];
        } else {
            echo "Nenhum arquivo de imagem enviado.";
        }
    }
    
    if (empty($nome) || empty($formula_molecular) || empty($estrutura_molecular) || empty($grupo_funcional_id) || empty($criado_por)) {
        echo 'Campos obrigatórios não preenchidos';
    }
} else {
    echo 'Método de requisição inválido.';
}
?>
