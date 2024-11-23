<?php
include 'dashboard_user.php';
include 'buscar.php';
$id_empresa = $_SESSION['user_id'];
// Definir tabela e colunas com base no tipo de exibição


$table = $_GET['table'] ?? 'empresas';
$columns = $_GET['columns'] ?? 'nome_empresa, cnpj';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Cadastrados</title>
    <style>
        /* Adicionar estilos semelhantes aos anteriores */
    </style>
</head>
<body>
    <h2><?php echo ucfirst($table); ?> Cadastrados</h2>
    <?php echo generateTable($result); ?>
</body>
</html>
