<?php
require_once '../../startup/connectBD.php';


$nome = addslashes($_POST['nome']);
$valor = addslashes($_POST['valor']);
$composto = addslashes($_POST['composto']);


if (!empty($nome)) {

   
        $query = "INSERT INTO `propriedades`(`id`, `composto_id`, `propriedade_nome`, `propriedade_valor`) VALUES (null, '$composto', '$nome', '$valor')";

        if ($mysqli->query($query)) {
            header("Location: ../../adminFront/listCadastros/list_propriedade.php");


        } else {
            echo "Erro ao inserir registro: " . $mysqli->error;
        }
    
} else {
    echo 'Nada digitado';
}
?>