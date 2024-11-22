<?php
include 'dashboard_admin.php';
// Incluir o arquivo de conexão com o banco de dados

$id_empresa = $_SESSION['user_id'];
// Consulta para selecionar todas as empresas
$sql = "SELECT nome_empresa, email, cnpj, cep, estado, cidade, bairro, rua, numero, complemento, telefone, celular 
            FROM empresas WHERE id_empresa = ?";

    // Preparar a consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular o parâmetro (id_empresa) à consulta
        $stmt->bind_param("i", $id_empresa);

        // Executar a consulta
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();
    }
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
    <h2>Empresas Cadastradas</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Nome da Empresa</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th>CEP</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Telefone</th>
                <th>Celular</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome_empresa']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['cnpj']); ?></td>
                    <td><?php echo htmlspecialchars($row['cep']); ?></td>
                    <td><?php echo htmlspecialchars($row['estado']); ?></td>
                    <td><?php echo htmlspecialchars($row['cidade']); ?></td>
                    <td><?php echo htmlspecialchars($row['bairro']); ?></td>
                    <td><?php echo htmlspecialchars($row['rua']); ?></td>
                    <td><?php echo htmlspecialchars($row['numero']); ?></td>
                    <td><?php echo htmlspecialchars($row['complemento']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($row['celular']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma empresa cadastrada.</p>
    <?php endif; ?>

    <?php
    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
