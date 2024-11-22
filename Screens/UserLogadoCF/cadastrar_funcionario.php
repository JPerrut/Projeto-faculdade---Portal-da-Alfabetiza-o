<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PBD/dashboard_user.php';

$sql = "SELECT id_funcionario, nome_func, email, data_nasc, numero, complemento, rua, bairro, cidade, estado, cep, escolaridade, sexo, turno, cpf, rg FROM funcionarios";
$result = $conn->query($sql);

$mensagem = "";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de funcionários</title>
    <link rel="stylesheet" href="cadastro_funcionario.css">
    <link rel="stylesheet" href="tabela.resgateCadastro.css">
    <link rel="stylesheet" href="../Geral/global.css">
    <link rel="stylesheet" href="../Geral/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>
    <script src="../Geral/header.js" defer></script>
    <script src="cadastro_funcionario.js" defer></script>
    <script src="editarUsuario.js" defer></script>
    <script src="cpf_cep_rg.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <nav class="nav-menu">
                <a href="/PBD/Screens/UserLogado/user_logado.html">
                    <div class="logo">PDA</div>
                </a>

                <div class="size-text">
                    <button class="button-size_text" id="increase-font">A+</button>
                    <button class="button-size_text" id="decrease-font">A-</button>
                </div> <!-- class="size-text" FIM -->
                
                <div><i id="mode-icon" class="fa-solid fa-moon icons"></i></div>
            </nav> <!-- class="nav-menu" FIM -->
        </div> <!-- class="container" FIM -->
    </header>
    <main>
        <div class="container">

            <div class="tabela-container">
                <h2>Cadastre um funcionário</h2>
                <?php
                // Exibe a mensagem de sucesso ou erro
                    echo $mensagem;
                ?>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Nasc</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo 
                                "<tr>
                                    <td>" . $row["id_funcionario"] . "</td>
                                    <td>" . $row["nome_func"] . "</td>
                                    <td>" . date("d/m/Y", strtotime($row['data_nasc'])) . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>
                                        <button class='button' onclick=\"editarUsuario(" . $row["id_funcionario"] . ", '" 
                                        . $row["nome_func"] . "', '" . $row["email"] . "', '" . $row["data_nasc"] . "', '" 
                                        . $row["cpf"] . "', '" . $row["rg"] . "', '" . $row["sexo"] . "', '" . $row["escolaridade"] 
                                        . "', '" . $row["turno"] . "', '" . $row["cep"] . "', '" . $row["estado"] . "', '" 
                                        . $row["cidade"] . "', '" . $row["bairro"] . "', '" . $row["rua"] . "', '" . $row["numero"] 
                                        . "', '" . $row["complemento"] . "')\">Editar</button>
                                        
                                        <form method='post' style='display:inline-block'>
                                                        <input type='hidden' name='id' value='" . $row["id_funcionario"] . "'>
                                                        <button class='button' type='submit' name='excluir' onclick=\"return confirm
                                                        ('Tem certeza que deseja excluir este usuário?')\">Excluir</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='17'>Nenhum dado encontrado</td></tr>";
                        }
                    ?>
                </table>
            </div>
    </div class="container">

    <form action="gerar_excel.php" method="post" class="formFunc" id="form">
        <button type="submit" class="button_excel">
            <img src="/PBD/images/user_logado/sim.png" alt="Ícone de Download" class="imagem_excel">
            <p>Baixar Planilha em Excel</p>
        </button>
        
        <section class="section_five" id="section_five">
            <form action="editar_dados.php" id="form" name="form" method="POST" class="formFunc">
                <h1>Cadastre um funcionário</h1>
                
                <input type="hidden" name="id_funcionario" id="id_funcionario" />
                
                <div class="input_group">
                    <div class="container_input">
                        <label for="nome_funcionario">Nome do Funcionário:</label>
                        <input type="text" name="nome_func" maxlength="80" id="nome_funcionario" placeholder="Digite o nome completo do funcionário" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="email">E-mail do funcionário:</label>
                        <input type="email" name="email" maxlength="50" id="email" placeholder="Digite o email do funcionário" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="rg">RG:</label>
                        <input type="text" name="rg" id="rg" placeholder="Digite o RG do funcionário" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END } -->
                    
                    <div class="container_input">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF do funcionário" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                </div> <!-- {class="input_group" > END} -->
                
                <div class="input_group">
                    <div class="container_input">
                        <label for="data_nasc">Data de Nascimento:</label>
                        <input type="text" name="data_nasc" id="data_nasc" placeholder="Digite a data de nascimento (DD/MM/AAAA)" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="turno">Turno Disponível:</label>
                        <select name="turno" id="turno">
                            <option value="" selected>Selecione</option>
                            <option value="Manhã">Manhã</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noite">Noite</option>
                        </select>
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="grau_escolaridade">Grau de Escolaridade:</label>
                        <select name="escolaridade" id="grau_escolaridade">
                            <option value="" selected>Selecione</option>
                            <option value="Analfabeto">Analfabeto</option>
                            <option value="Ensino_FI">Ensino Fundamental Incompleto</option>
                            <option value="Ensino_MI">Ensino Médio Incompleto</option>
                        </select>
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                </div> <!-- {class="input_group" > END} -->
                
                <div class="input_group">
                    <div class="container_input">
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo">
                            <option value="" selected>Selecione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" placeholder="Digite o CEP do funcionário" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="estado">Estado:</label>
                        <input type="text" name="estado" id="estado" placeholder="Digite o estado" readOnly />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                </div> <!-- {class="input_group" > END} -->

                <div class="input_group">
                    <div class="container_input">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade" readOnly />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Digite o bairro" readOnly />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="rua">Rua:</label>
                        <input type="text" name="rua" id="rua" placeholder="Digite o nome da rua" readOnly />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                </div> <!-- {class="input_group" > END} -->
                
                <div class="input_group">
                    <div class="container_input">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" placeholder="Digite o número" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                    
                    <div class="container_input">
                        <label for="complemento">Complemento:</label>
                        <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento (opcional)" />
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
                </div> <!-- {class="input_group" > END} -->
                
                <div id="successMessage"></div>
                
                <div class="buttons">
                    <input class="button" type="submit" name="cadastrar" id="submitBtn" value="Adicionar">
                    <input class="button" type="submit" name ="editar" value="Salvar Edição">
                    <button class="button" type="button" id="clearBtn">Limpar Seleções</button>
                </div> <!-- {class="buttons" > END} -->
            </form> <!-- {class="formFunc" > END} -->
        </section> <!-- {class="section_five" > END} -->
        
    </div>
</main>

</body>
</html>