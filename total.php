<?php
require_once 'startup/connectBD.php';
session_start();

if (!isset($_SESSION['email']) || ($_SESSION['tipo'] !== 'admin' )) {
    header('Location: http://localhost:3000/');
    exit();
}
// Consulta para obter o total de compostos
$sql_total_compostos = "SELECT COUNT(*) AS total_compostos FROM compostos";
$result_total_compostos = $mysqli->query($sql_total_compostos);
$row_total_compostos = $result_total_compostos->fetch_assoc();
$total_compostos = $row_total_compostos['total_compostos'];

// Consulta para obter o total de grupos funcionais
$sql_total_grupos_funcionais = "SELECT COUNT(*) AS total_grupos_funcionais FROM grupos_funcionais";
$result_total_grupos_funcionais = $mysqli->query($sql_total_grupos_funcionais);
$row_total_grupos_funcionais = $result_total_grupos_funcionais->fetch_assoc();
$total_grupos_funcionais = $row_total_grupos_funcionais['total_grupos_funcionais'];

// Consulta para obter o total de propriedades
$sql_total_propriedades = "SELECT COUNT(*) AS total_propriedades FROM propriedades";
$result_total_propriedades = $mysqli->query($sql_total_propriedades);
$row_total_propriedades = $result_total_propriedades->fetch_assoc();
$total_propriedades = $row_total_propriedades['total_propriedades'];

// Consulta para obter o total de usos
$sql_total_usos = "SELECT COUNT(*) AS total_usos FROM usos";
$result_total_usos = $mysqli->query($sql_total_usos);
$row_total_usos = $result_total_usos->fetch_assoc();
$total_usos = $row_total_usos['total_usos'];

// Fechar conexão com o banco de dados
$mysqli->close();

// Retornar os totais como um array JSON
$total_data = array(
    'total_compostos' => $total_compostos,
    'total_grupos_funcionais' => $total_grupos_funcionais,
    'total_propriedades' => $total_propriedades,
    'total_usos' => $total_usos
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Barras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        header {
            /* Adicione seu estilo aqui, se necessário */
        }
        main {
            width: 100%;
            min-height: 500px;
            height: auto;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = <?php echo json_encode($total_data); ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Categoria');
            data.addColumn('number', 'Total');

            data.addRows([
                ['Compostos', parseInt(jsonData.total_compostos)],
                ['Grupos Funcionais', parseInt(jsonData.total_grupos_funcionais)],
                ['Propriedades', parseInt(jsonData.total_propriedades)],
                ['Usos', parseInt(jsonData.total_usos)]
            ]);

            var options = {
                title: 'Totais por Categoria',
                legend: { position: 'none' },
               
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
<header>
        <div class="card">
            <div class="card-header">
                Olá, seja bem-vindo(a)
            </div>
            <div class="card-body">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="total.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="adminFront/listCadastros/list_composto.php">Compostos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="adminFront/listCadastros/list_grupos.php">Grupos Funcionais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="adminFront/listCadastros/list_propriedade.php">Propriedades</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="adminFront/listCadastros/list_usos.php">Usos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="adminFront/listCadastros/list_users.php">Usúarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="http://localhost:3000/">Site</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-disabled="true" href="adminBack/sair.php">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
           
        </div>
    </header>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
</body>
</html>

