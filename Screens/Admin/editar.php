<?php
// Conexão com o banco de dados
$host = 'localhost';
$db_usuario = 'root';
$db_senha = '7634';
$db_nome = 'portal';

$conn = new mysqli($host, $db_usuario, $db_senha, $db_nome);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$mensagem_sucesso = ""; 
// Variável para armazenar mensagem de sucesso

// Atualizar os dados se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_escola = $_POST['id_escola'];
    $nome_escola = $_POST['nome_escola'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $complemento = $_POST['complemento'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];
    $numero = $_POST['numero'];
    $rua = $_POST['rua'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $hora_aula = $_POST['hora_aula']; 

    $sql = "UPDATE escola SET 
                nome_escola = ?, 
                bairro = ?, 
                cep = ?, 
                cidade = ?, 
                complemento = ?, 
                email = ?, 
                estado = ?, 
                numero = ?, 
                rua = ?, 
                telefone = ?, 
                celular = ?,
                hora_aula = ? 
            WHERE id_escola = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $nome_escola, $bairro, $cep, $cidade, $complemento, $email, $estado, $numero, $rua, $telefone, $celular, $hora_aula, $id_escola);

    if ($stmt->execute()) {
        $mensagem_sucesso = "Dados atualizados com sucesso!";
    } else {
        $mensagem_sucesso = "Erro ao atualizar os dados: " . $stmt->error;
    }

    $stmt->close();
}

// Buscar todos os dados para exibir na tabela
$sql = "SELECT * FROM escola";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escolas</title>
    <link rel="stylesheet" href="editar.css">
    <style>
        /* Estilo da mensagem de sucesso */
        .success-message {
            color: #4caf50;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #4caf50;
            border-radius: 5px;
            background-color: rgba(76, 175, 80, 0.1);
            opacity: 1;
            transition: opacity 1s ease;
        }

        /* Animação da seção de edição */
        .edit-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .edit-section.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Escolas</h1>

        <!-- Mensagem de Sucesso -->
        <?php if ($mensagem_sucesso): ?>
            <div id="mensagem-sucesso" class="success-message"><?= htmlspecialchars($mensagem_sucesso) ?></div>
        <?php endif; ?>

        <table class="school-table">
            <tr>
                <th>ID</th>
                <th>Nome da Escola</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_escola']) ?></td>
                    <td><?= htmlspecialchars($row['nome_escola']) ?></td>
                    <td><?= htmlspecialchars($row['bairro']) ?></td>
                    <td><?= htmlspecialchars($row['cidade']) ?></td>
                    <td>
                        <a class="edit-button" href="?id_escola=<?= $row['id_escola'] ?>">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php
        $result->free();

        $id_escola = $_GET['id_escola'] ?? null;
        if ($id_escola) {
            $sql = "SELECT * FROM escola WHERE id_escola = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_escola);
            $stmt->execute();
            $result = $stmt->get_result();
            $escola = $result->fetch_assoc();
            $stmt->close();
        }
        ?>

        <?php if (!empty($escola)): ?>
            <div class="edit-section" id="edit-section">
                <h1>Editar Informações da Escola</h1>
                <form method="POST" action="">
                    <input type="hidden" name="id_escola" value="<?= htmlspecialchars($escola['id_escola']) ?>">
                    <label for="nome_escola">Nome da Escola:</label>
                    <input type="text" name="nome_escola" value="<?= htmlspecialchars($escola['nome_escola']) ?>" required><br>

                    <label for="bairro">Bairro:</label>
                    <input type="text" name="bairro" value="<?= htmlspecialchars($escola['bairro']) ?>" required><br>

                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" value="<?= htmlspecialchars($escola['cep']) ?>" required><br>

                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" value="<?= htmlspecialchars($escola['cidade']) ?>" required><br>

                    <label for="complemento">Complemento:</label>
                    <input type="text" name="complemento" value="<?= htmlspecialchars($escola['complemento']) ?>"><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($escola['email']) ?>" required><br>

                    <label for="estado">Estado:</label>
                    <input type="text" name="estado" value="<?= htmlspecialchars($escola['estado']) ?>" required><br>

                    <label for="numero">Número:</label>
                    <input type="text" name="numero" value="<?= htmlspecialchars($escola['numero']) ?>" required><br>

                    <label for="rua">Rua:</label>
                    <input type="text" name="rua" value="<?= htmlspecialchars($escola['rua']) ?>" required><br>

                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" value="<?= htmlspecialchars($escola['telefone']) ?>" required><br>

                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" value="<?= htmlspecialchars($escola['celular']) ?>" required><br>

                    <label for="hora_aula">Hora da Aula:</label>
                    <input type="text" name="hora_aula" value="<?= htmlspecialchars($escola['hora_aula']) ?>" required><br>

                    <button type="submit">Salvar Alterações</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Exibir a mensagem temporariamente e com efeito de desaparecimento
        window.addEventListener("DOMContentLoaded", function() {
            const mensagem = document.getElementById('mensagem-sucesso');
            if (mensagem) {
                setTimeout(() => {
                    mensagem.style.opacity = '0';
                }, 3000); // Inicia o desaparecimento após 3 segundos
                setTimeout(() => {
                    mensagem.style.display = 'none';
                }, 4000); // Remove completamente após 4 segundos
            }

            // Exibir a seção de edição com animação, se estiver presente
            const editSection = document.getElementById('edit-section');
            if (editSection) {
                setTimeout(() => {
                    editSection.classList.add('show');
                }, 200); // Atraso breve para o efeito de suavidade
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
