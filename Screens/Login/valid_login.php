<?php
session_start();
include '../../conexao.php';
var_dump($conn); // Verifique se a conexão foi bem-sucedida


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = filter_var(trim($_POST['loginEmail']), FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars(trim($_POST['loginSenha']), ENT_QUOTES, 'UTF-8');

    // Verificando se a conexão com o banco de dados foi bem-sucedida
    if ($conn === false) {
        echo "Erro na conexão com o banco de dados.";
        exit();
    }

    // Preparando a consulta SQL
    $sql = $conn->prepare("SELECT id_empresa, nome_empresa, senha, is_admin  FROM empresas WHERE email = ?");
    
    // Verificando se a preparação da consulta foi bem-sucedida
    if ($sql === false) {
        echo "Erro na preparação da consulta: " . $conn->error;
        exit();
    }

    // Associando o parâmetro e executando a consulta
    $sql->bind_param("s", $email);
    $sql->execute();
    $sql->store_result();

    // Verificando se a consulta retornou resultados
    if ($sql->num_rows > 0) {
        $sql->bind_result($id_empresa, $name,$senha_armazenada, $is_admin);
        $sql->fetch();

        // Verificando a senha
        if (password_verify($senha, $senha_armazenada)) {
            //Armazenando dados
            $_SESSION['user_id'] = $id_empresa;
            $_SESSION['nome_empresa'] = $name;
            $_SESSION['is_admin'] = $is_admin;
            
            //Selecionando o tipo de usuário
            if ($is_admin) {
                header("Location: ../../Screens/UserLogado/user_logado.php");
            } else {
                header("Location: ../../Screens/UserLogado/user_logado.php");
            }
            exit();

            
        } else {
            echo "E-mail ou senha inválidos.";
        }
    } else {
        echo "E-mail ou senha inválidos.";
    }

    // Fechando a consulta
    $sql->close();
}

// Fechando a conexão com o banco
$conn->close();
?>
