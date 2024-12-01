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

// Lista de tabelas válidas
$tabelasAceitas = ['empresas', 'funcionarios'];
if (!in_array($tableName, $tabelasAceitas)) {
    die("Tabela inválida.");
}

// Lista de colunas válidas
$colunasAceitas = ['id_empresa', 'id_funcionario', 'nome_func', 'rg', 'cpf', 'turno', 'sexo', 'escolaridade', 'data_nasc',  'nome_empresa', 'cnpj', 'email', 'telefone', 'bairro','cep','estado', 'cidade', 'rua ', 'numero', 'complemento', 'telefone', 'celular', ];
$columns = $_GET['columns'] ?? null;
if (!$columns) {
    die("Colunas inválidas ou ausentes.");
}
$arrayColunas = explode(',', $columns);

// Verifica se as colunas são válidas
foreach ($arrayColunas as $column) {
    if (!in_array(trim($column), $colunasAceitas)) {
        die("Coluna inválida: $column");
    }
}

if (filter_var($id, FILTER_VALIDATE_INT) === false) {
    die("ID inválido. O valor fornecido não é um inteiro.");
}

// Busca os dados existentes
$query = "SELECT $columns FROM $tableName WHERE id_empresa = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados, excluindo `id_empresa`
    $updates = [];
    $values = [];

    foreach ($_POST as $column => $value) {
        if ($column !== 'id_empresa') { // Ignorar id_empresa
            $updates[] = "$column = ?";
            $values[] = $value;
        }
    }

    $sql = "UPDATE $tableName SET " . implode(", ", $updates) . " WHERE id_empresa = ?";
    $stmt = $conn->prepare($sql);

    // Adicionar id_empresa como parâmetro para WHERE
    $values[] = $id;
    $types = str_repeat('s', count($values) - 1) . 'i'; // Tipos dinâmicos
    $stmt->bind_param($types, ...$values);
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
                <?php if ($column !== 'id_empresa'): ?>
                    <!-- Campos editáveis para outras colunas -->
                    <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?></label>
                    <input type="text" id="<?php echo $column; ?>" name="<?php echo $column; ?>" value="<?php echo htmlspecialchars($value); ?>">
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit">Salvar</button>
        <?php else: ?>
            <p>Nenhum dado encontrado.</p>
        <?php endif; ?>
    </form>
</body>
</html>
