<?php
include 'dashboard_adminOFC.php';
$id_empresa = $_SESSION['user_id'];
// Definir tabela e colunas com base no tipo de exibição
$tableName = $_GET['table'] ?? 'empresas';
$columns = $_GET['columns'] ?? 'id_empresa,nome_empresa,email,telefone';
$isAdmin = $_GET['isAdmin'] ?? TRUE;
include 'buscarOFC.php';
include 'verificar_tabelaOFC.php';
unset($_POST['id_empresa']);

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Cadastradas</title>

    <link rel="stylesheet" href="Screens/Geral/header.css">
    <link rel="stylesheet" href="Screens/Geral/global.css">
    <link rel="stylesheet" href="admin_empresas.css">
  
</head>
<body>

<header>
    <div class="container">
        <nav class="nav-menu">
            <a href="../../index.html">
                <div class="logo">INICIO</div>
            </a>
        </nav> <!-- class="nav-menu" FIM -->
    </div> <!-- class="container" FIM -->
</header>

<main>
    <div class="container">
        <h2><?php echo ucfirst($tableName); ?> Cadastrados</h2>
        <div class="tabela">
            <?php echo generateTable($result, $tableName, $columns); ?>
        </div>
    </div>
</main>

<?php
// Fechar a conexão
$conn->close();
?>

</body>
</html>