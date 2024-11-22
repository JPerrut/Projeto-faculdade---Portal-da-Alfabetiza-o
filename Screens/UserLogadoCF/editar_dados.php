<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PBD/dashboard_user.php';
$id_empresa = $_SESSION['user_id'];
$mensagem = "";

if (isset($_POST['editar']) || isset($_POST['cadastrar'])) {
    $id = isset($_POST['id_funcionario']) ? $_POST['id_funcionario'] : null;
    $nome_func = isset($_POST['nome_func']) ? $_POST['nome_func'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $data_nasc = isset($_POST['data_nasc']) ? $_POST['data_nasc'] : null;
    $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
    $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : null;
    $rua = isset($_POST['rua']) ? $_POST['rua'] : null;
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
    $estado = isset($_POST['estado']) ? $_POST['estado'] : null;
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
    $escolaridade = isset($_POST['escolaridade']) ? $_POST['escolaridade'] : null;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
    $turno = isset($_POST['turno']) ? $_POST['turno'] : null;
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $rg = isset($_POST['rg']) ? $_POST['rg'] : null;

    $sql = $conn->prepare("INSERT INTO funcionarios (nome_func, rg, cpf, data_nasc, turno, email, escolaridade, sexo, cep, estado, cidade, bairro, rua, numero, complemento, id_empresa) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssssssssssssi", $nome_funcionario, $rg, $cpf, $data_nasc, $turno, $email, $grau_escolaridade, $sexo, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento, $id_empresa);
   
    
    if ($conn->query($sql) === TRUE) {
        $mensagem = "<div id='feedback' class='feedback-msg success-msg'>Usuário editado com sucesso!</div>";
    } else {
        $mensagem = "<div id='feedback' class='feedback-msg error-msg'>Erro ao editar usuário: " . $conn->error . "</div>";
    }
     // Fechar a consulta preparada
     $sql->close();
}

if (isset($_POST['excluir'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM funcionarios WHERE id_funcionario=$id";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "<div id='feedback' class='feedback-msg success-msg'>Usuário excluído com sucesso!</div>";
    } else {
        $mensagem = "<div id='feedback' class='feedback-msg error-msg'>Erro ao excluir usuário: " . $conn->error . "</div>";
    }
}
// Fechar a conexão com o banco de dados
$conn->close();
?>