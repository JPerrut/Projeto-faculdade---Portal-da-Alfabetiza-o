<?php
include 'dashboard_adminOFC.php';
$id_empresa = $_SESSION['user_id'];
// Definir tabela e colunas com base no tipo de exibição
$tableName = $_GET['table'] ?? 'empresas';
$columns = $_GET['columns'] ?? '*';
$isAdmin = $_GET['isAdmin'] ?? TRUE;
$empresa = $_GET['coluna'] ?? 'id_empresa';
include 'buscarOFC.php';
include 'verificar_tabelaOFC.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Cadastradas</title>
    <style>
/* Estilo geral da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Estilos para a tabela */
        table {
            width: 100%;
            max-width: 1200px;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            color: #333;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf3e9;
            transition: background-color 0.2s;
        }

        /* Estilo responsivo para dispositivos móveis */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                width: 100%;
            }

            th, td {
                padding: 8px 10px;
            }

            tr {
                display: block;
                margin-bottom: 10px;
            }

            th, td {
                display: block;
                text-align: right;
            }

            th::before, td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }

            th {
                background-color: #4CAF50;
                color: #fff;
            }

            td {
                border-top: 1px solid #ddd;
            }
        }


    </style>
</head>
<body>
    <h2><?php echo ucfirst($tableName); ?> Cadastrados</h2>
    <?php echo generateTable($result, $tableName); ?>

    <?php
    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
