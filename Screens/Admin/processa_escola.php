<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtendo os dados do formulário
    $nome_escola = $_POST['nome_escola'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $complemento = $_POST['complemento'] ?? null;
    $email = $_POST['email'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $celular = $_POST['celular'] ?? null;
    $hora_aula = $_POST['hora_aula'] ?? null;

    if ($nome_escola && $bairro && $cep && $cidade && $email && $estado && $numero && $rua && $telefone && $hora_aula && $celular) {
        try {

            $dsn = 'mysql:host=localhost;dbname=portal;charset=utf8mb4';
            $db_usuario = 'root';
            $db_senha = '7634';

            $pdo = new PDO($dsn, $db_usuario, $db_senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inserindo os dados na tabela escola
            $sql = "INSERT INTO escola 
                (nome_escola, bairro, cep, cidade, complemento, email, estado, numero, rua, telefone, celular, hora_aula) 
                VALUES 
                (:nome_escola, :bairro, :cep, :cidade, :complemento, :email, :estado, :numero, :rua, :telefone, :celular, :hora_aula)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome_escola' => $nome_escola,
                ':bairro' => $bairro,
                ':cep' => $cep,
                ':cidade' => $cidade,
                ':complemento' => $complemento,
                ':email' => $email,
                ':estado' => $estado,
                ':numero' => $numero,
                ':rua' => $rua,
                ':telefone' => $telefone,
                ':celular' => $celular,
                ':hora_aula' => $hora_aula,
            ]);

            echo "Escola cadastrada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar escola: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
