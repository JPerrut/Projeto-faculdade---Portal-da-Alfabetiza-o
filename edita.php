<?php
session_start();
include 'conexaoOFC.php';

// Captura os parâmetros
$id = $_GET['id'] ?? null;
$tableName = $_GET['table'] ?? null;

if (!$id || !$table) {
    die("ID ou tabela inválidos.");
}

// Busca os dados existentes
$query = "SELECT * FROM $table WHERE id = ?";
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
    $sql = "UPDATE $table SET " . implode(", ", $updates) . " WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $types = str_repeat('s', count($_POST)) . 'i';
    $params = array_merge(array_values($_POST), [$id]);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    // Redireciona após o sucesso para evitar reenvio do formulário
    header("Location: admin_empresasOFC.php?table=$table");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo ucfirst($table); ?></title>
</head>
<body>
    <h2>Editar <?php echo ucfirst($table); ?></h2>
    <form method="POST">
        <?php foreach ($data as $column => $value): ?>
            <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?></label>
            <input type="text" id="<?php echo $column; ?>" name="<?php echo $column; ?>" value="<?php echo htmlspecialchars($value); ?>">
            <br>
        <?php endforeach; ?>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
