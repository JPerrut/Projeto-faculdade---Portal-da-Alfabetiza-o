<?php

include '../../dashboard_user.php';
// Conexão com o banco de dados

// Obtém o ID do usuário logado
$user_id = $_SESSION['user_id'];

// Inicializa a variável para os dados do usuário
$user = ['email' => '', 'senha' => ''];

// Se o formulário foi enviado, atualiza os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    $sql = "UPDATE empresas SET email = ?, senha = ? WHERE id_empresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $email, $senha, $user_id);

    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados: " . $stmt->error;
    }
}

// Sempre busca os dados atuais para exibição
$sql = "SELECT email, senha FROM empresas WHERE id_empresa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows === 1) {
    $user = -$result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit;
}
?>
