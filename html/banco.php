<?php 
// Parâmetros de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "portal"; //Nome do BD

// Criando a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificando se os dados foram enviados pelo método POST
if (isset($_POST['cadastrar'])) {
    $nome_empresa = $_POST['nome_empresa'];
    $cnpj = $_POST['cnpj'];
    $senha_empresa = $_POST['senha'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];

    // SQL para inserir os dados
    $sql = "INSERT INTO empresas (nome_empresa, cnpj, senha, email, cep, estado, cidade, bairro, rua, numero, complemento, telefone, celular)
            VALUES ('$nome_empresa', '$cnpj', '$senha_empresa', '$email', '$cep', '$estado', '$cidade', '$bairro', '$rua', '$numero', '$complemento', '$telefone', '$celular')";

    // Executando a inserção e verificando se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fechando a conexão
    $conn->close();
}



?>