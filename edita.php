<?php
session_start();
include 'conexaoOFC.php';

// Captura os parâmetros

$columns = $_GET['columns'] ?? null;
$tableName = $_GET['table'] ?? null;
$isAdmin = $_GET['isAdmin'] ?? null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$tableName) {
    die("Tabela inválida.");
}

// Busca apenas uma informação
$query = "SELECT id_empresa FROM $tableName";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
 
$tabelasAceitas = ['empresas', 'funcionarios']; // Lista de tabelas válidas
if (!in_array($tableName, $tabelasAceitas)) {
    die("Tabela inválida.");
} 

$colunasAceitas = ['id_empresa', 'nome_empresa', 'cnpj', 'email'];

// Divide as colunas passadas (caso haja mais de uma)
$arrayColunas = explode(',', $columns);

// Verifica se cada coluna passada é válida
foreach ($arrayColunas as $column) {
    if (!in_array(trim($column), $colunasAceitas)) {
        die("Coluna inválida: $column");
    }  
}  
  
// Lista de colunas permitidas

if (filter_var($id, FILTER_VALIDATE_INT) === false) {
    die("ID inválido. O valor fornecido não é um inteiro.");
} 

// Busca os dados existentes
$query = "SELECT $columns FROM $tableName WHERE id_empresa = $id";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados  

    $updates = [];
    foreach ($_POST as $column => $value) {
        $updates[] = "$column = ?";
    }
    $sql = "UPDATE $tableName SET " . implode(", ", $updates) . " WHERE id_empresa = $id";
    $stmt = $conn->prepare($sql);

    $types = str_repeat('s', count($columns));
    $params = array_merge(array_values($columns),);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    // Redireciona após o sucesso para evitar reenvio do formulário
    header("Location: admin_empresasOFC.php?table=$tableName");
    exit();
}
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo ucfirst($tableName); ?></title>
</head>
<body>
    <h2>Editar <?php echo ucfirst($tableName); ?></h2>
    <form method="POST">
        <?php if ($data): ?>
            <?php foreach ($data as $column => $value): ?>
                <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?></label>
                <input type="text" id="<?php echo $column; ?>" name="<?php echo $column; ?>" value="<?php echo htmlspecialchars($value); ?>">
                <br>
            <?php endforeach; ?>
            <button type="submit">Salvar</button>
        <?php else: ?>
            <p>Nenhum dado encontrado </p>
        <?php endif; ?>
    </form>
</body>
</html>
