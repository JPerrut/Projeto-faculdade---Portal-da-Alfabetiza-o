<?php
include 'editarPerfil.php';

// Exibe a tabela com os dados cadastrados
$table = $_GET['table'] ?? 'empresas';
$columns = $_GET['columns'] ?? 'nome_empresa, cnpj';
include '../../../verificar_tabela.php';

?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Cadastradas</title>
    <style>
        /* Adicione aqui os estilos anteriores */
        /* Seu estilo de tabela, responsividade, etc. */
    </style>
</head>
<body> 
    <header>
        <div class="container">
            <nav class="nav-menu">
                <a href="../../index.html">
                    <div class="logo">PDA</div>
                </a>
                <div class="size-text">
                    <button class="button-size_text" id="increase-font">A+</button>
                    <button class="button-size_text" id="decrease-font">A-</button>
                </div> <!-- class="size-text" > END -->
                
                <div><i id="mode-icon" class="fa-solid fa-moon icons"></i></div>
            </nav> <!-- class="nav-menu" > END -->
        </div> <!-- class="container" > END -->
    </header>
    <main>
        <div class="container">

            <!-- Formulário de alteração de email e senha -->
            <h3>Alterar Email e Senha</h3>
            <?php if ($message): ?>
            <p style="color: green;"><?php echo $message; ?></p>
            <?php endif; ?>
            <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?> 
                    
            <form method="POST"> 
                <!-- Alteração de Email -->
                <label for="email_atual">Email Atual:</label><br>
                <input type="email" id="email_atual" name="email_atual"><br><br>
                
                <label for="novo_email">Novo Email:</label><br>
                <input type="email" id="novo_email" name="novo_email"><br><br>
                
                <!-- Alteração de Senha -->
                <label for="senha_atual">Senha Atual:</label><br>
                <input type="password" id="senha_atual" name="senha_atual"><br><br>
                
                <label for="nova_senha">Nova Senha:</label><br>
                <input type="password" id="nova_senha" name="nova_senha"><br><br>
                
                <label for="confirmar_senha">Confirmar Nova Senha:</label><br>
                <input type="password" id="confirmar_senha" name="confirmar_senha"><br><br>
                
                <button type="submit">Atualizar Dados</button>
            </form>
            
            <?php 
            // Fechar a conexão
            $conn->close(); 
            ?>
        </div>
    </main>
</body>
</html>
