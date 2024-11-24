<?php
session_start();
include 'conexaoOFC.php';
$table = $_SESSION['table'];
$columns = $_SESSION['columns'];

function fetchData($table, $columns, $where = null, $conn) {
    // Valida a tabela e as colunas
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        die("Nome de tabela inválido.");
    }

    if (!is_string($columns) || empty($columns)) {
        die("Colunas inválidas.");
    }

    $sql = "SELECT $columns FROM $table";

    if ($where) {
        $conditions = [];
        foreach ($where as $column => $value) {
            $conditions[] = "$column = ?";
        }
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $conn->prepare($sql);
    if ($where) {
        $types = str_repeat("s", count($where)); // Assume strings; ajuste conforme necessário
        $stmt->bind_param($types, ...array_values($where));
    }

    $stmt->execute();
    return $stmt->get_result();
}

// Validar entrada
$id = $_GET['id'] ?? null;
$table = $_GET['table'] ?? null;
if (!$id || !$table) {
    die("ID ou tabela inválidos.");
}

// Buscar dados existentes
$result = fetchData($table, "*", ['id' => $id], $conn);
$data = $result->fetch_assoc();
include 'verificar_tabelaOFC.php';
// Atualizar dados se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    foreach ($_POST as $columns => $value) {
        $updates[] = "$columns = ?";
    } 

    $sql = "UPDATE $table SET " . implode(", ", $updates) . " WHERE id = ?";
    $stmt = $conn->prepare($sql);
 
    $types = str_repeat("s", count($_POST)) . "i";
    $params = array_merge(array_values($_POST), [$id]);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    echo "<p>Dados atualizados com sucesso.</p>";
    echo "<a href='index.php?table=$table'>Voltar</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Dados</title>
</head>
<body>
    <h2>Editar <?php echo ucfirst($table); ?></h2>
    <form method="POST">
        <?php foreach ($data as $columns => $value): ?>
            <label for="<?php echo $columns; ?>"><?php echo ucfirst($columns); ?></label>
            <input type="text" id="<?php echo $columns; ?>" name="<?php echo $columns; ?>" value="<?php echo htmlspecialchars($value); ?>">
            <br>
        <?php endforeach; ?>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
