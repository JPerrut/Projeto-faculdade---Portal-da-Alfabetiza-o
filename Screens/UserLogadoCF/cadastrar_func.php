<?php
//ini_set('display_errors', 1); 
//error_reporting(E_ALL);

// Incluir o arquivo de conexão com o banco de dados
include $_SERVER['DOCUMENT_ROOT'] . '/PBD/dashboard.php';

$id_empresa = $_SESSION['user_id'];

// Verificar se o formulário foi enviado com o parâmetro 'cadastrar'
if (isset($_POST['cadastrar']) || isset($_POST[''])) {
    // Capturar e sanitizar os dados do formulário
    $nome_funcionario = isset($_POST['nome_funcionario']) ? $_POST['nome_funcionario'] : '';
    $rg = isset($_POST['rg']) ? $_POST['rg'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $data_nasc = isset($_POST['data_nasc']) ? $_POST['data_nasc'] : '';
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $grau_escolaridade = isset($_POST['grau_escolaridade']) ? $_POST['grau_escolaridade'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
    $rua = isset($_POST['rua']) ? $_POST['rua'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
    
    // Preparar a consulta SQL para inserir os dados no banco de dados
    $sql = $conn->prepare("INSERT INTO funcionarios (nome_func, rg, cpf, data_nasc, turno, email, escolaridade, sexo, cep, estado, cidade, bairro, rua, numero, complemento, id_empresa) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssssssssssssi", $nome_funcionario, $rg, $cpf, $data_nasc, $turno, $email, $grau_escolaridade, $sexo, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento, $id_empresa);
   
    
    // Executar a consulta e verificar se foi bem-sucedida
    if ($sql->execute()) {
        header ("Location:resgatar_func.php");
        exit();
    } else {
        echo "Erro ao cadastrar funcionário: " . $sql->error;
    }

    // Fechar a consulta preparada
    $sql->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>