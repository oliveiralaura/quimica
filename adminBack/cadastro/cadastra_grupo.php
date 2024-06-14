<?php
require_once '../../startup/connectBD.php';


$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['desc']);


if (!empty($nome)) {

    $sql_conflito = "SELECT * FROM grupos_funcionais WHERE nome LIKE '$nome';";
    $result_conflito = $mysqli->query($sql_conflito);

    if (mysqli_num_rows($result_conflito) > 0) {
        echo 'Já existe um grupo funcional com esse nome.';
    } else {
        $query = "INSERT INTO `grupos_funcionais`(`id`, `nome`, `descricao`) VALUES (null, '$nome', '$descricao')";

        if ($mysqli->query($query)) {
            header("Location: ../../adminFront/listCadastros/list_grupos.php");


        } else {
            echo "Erro ao inserir registro: " . $mysqli->error;
        }
    }
} else {
    echo 'Nada digitado';
}
?>