<?php
include 'dashboard_user.php';
include 'buscar.php';

$id_empresa = $_SESSION['user_id'];


// Definir tabela e colunas com base no tipo de exibição
$table = $_GET['table'] ?? 'empresas';
$columns = $_GET['columns'] ?? 'nome_empresa, cnpj';
include 'verificar_tabela.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários Cadastrados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h2>Funcionários Cadastrados</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Turno</th>
                <th>Escolaridade</th>
                <th>Sexo</th>
                <th>CEP</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Complemento</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome_func']); ?></td>
                    <td><?php echo htmlspecialchars($row['rg']); ?></td>
                    <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($row['data_nasc']); ?></td>
                    <td><?php echo htmlspecialchars($row['turno']); ?></td>
                    <td><?php echo htmlspecialchars($row['escolaridade']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['sexo']); ?></td>
                    <td><?php echo htmlspecialchars($row['cep']); ?></td>
                    <td><?php echo htmlspecialchars($row['estado']); ?></td>
                    <td><?php echo htmlspecialchars($row['cidade']); ?></td>
                    <td><?php echo htmlspecialchars($row['bairro']); ?></td>
                    <td><?php echo htmlspecialchars($row['rua']); ?></td>
                    <td><?php echo htmlspecialchars($row['numero']); ?></td>
                    <td><?php echo htmlspecialchars($row['complemento']); ?></td>
                </tr>
            <?php endwhile;  //Termina a estrutura de repetição ?> 
        </table>
    <?php else: ?>
        <p>Nenhum funcionário cadastrado.</p>
    <?php endif; ?>

    <?php
    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>