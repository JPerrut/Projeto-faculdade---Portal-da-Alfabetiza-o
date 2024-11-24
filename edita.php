<?php
session_start();
include 'conexaoOFC.php';

// Captura os parâmetros
$tableName = $_GET['table'] ?? null;
$isAdmin = $_GET['isAdmin'] ?? null;
$coluna = $_GET['coluna'] ?? null;
if (!$tableName) {
    die("Tabela inválida.");
}

// Busca apenas uma informação
$query = "SELECT id_empresa FROM $tableName";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Armazena a informação em uma variável global, caso exista
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idempresa = $row['id_empresa']; // 
    $_SESSION['id_empresa'] = $idempresa; // Opcional: também armazena na sessão
} else {
    $globalVar = null; // Define como nulo caso nenhum dado seja encontrado
}
$idempresa = $_SESSION['id_empresa'];
// Busca os dados existentes
$query = "SELECT * FROM $tableName WHERE id_empresa = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $idempresa);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados
    $updates = [];
    foreach ($_POST as $column => $value) {
        $updates[] = "$column = ?";
    }
    $sql = "UPDATE $tableName SET " . implode(", ", $updates) . " WHERE id_empresa = ?";
    $stmt = $conn->prepare($sql);

    $types = str_repeat('s', count($_POST)) . 'i';
    $params = array_merge(array_values($_POST), [$idempresa]);
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
