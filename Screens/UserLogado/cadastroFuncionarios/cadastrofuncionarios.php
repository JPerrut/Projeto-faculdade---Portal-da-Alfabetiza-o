<?php  
// Conexão com o banco
include '../../../dashboard_userOFC.php';
$id_empresa = $_SESSION['user_id'];
$name = $_SESSION['nome_empresa'];

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = ""; 
    if (isset($_POST['adicionar'])) {
        try {
            $sql = "INSERT INTO funcionarios (nome_func, email, data_nasc, numero, complemento, rua, bairro, cidade, 
                estado, cep, escolaridade, sexo, turno, cpf, rg, id_empresa) 
                    VALUES ('{$_POST['nome_func']}', '{$_POST['email']}', '{$_POST['data_nasc']}', '{$_POST['numero']}', 
                    '{$_POST['complemento']}', '{$_POST['rua']}', '{$_POST['bairro']}', '{$_POST['cidade']}', 
                    '{$_POST['estado']}', '{$_POST['cep']}', '{$_POST['escolaridade']}', '{$_POST['sexo']}', 
                    '{$_POST['turno']}', '{$_POST['cpf']}', '{$_POST['rg']}', $id_empresa)";
            $conn->query($sql);
            $mensagem = "<div class='feedback-msg success-msg'>Novo usuário adicionado com sucesso!</div>";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                if (strpos($e->getMessage(), 'cpf') !== false) {
                    $mensagem = "<div class='feedback-msg error-msg'>Erro: O CPF já está em uso.</div>";
                } elseif (strpos($e->getMessage(), 'rg') !== false) {
                    $mensagem = "<div class='feedback-msg error-msg'>Erro: O RG já está em uso.</div>";
                } else {
                    $mensagem = "<div class='feedback-msg error-msg'>Erro: Dados já cadastrados.</div>";
                }
            } else {
                $mensagem = "<div class='feedback-msg error-msg'>Erro ao adicionar usuário: " . $e->getMessage() . "</div>";
            }
        }
    }
    
        
    if (isset($_POST['editar'])) {
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

        $sql = "UPDATE funcionarios SET nome_func='$nome_func', email='$email', data_nasc='$data_nasc', 
        numero='$numero', complemento='$complemento', rua='$rua', bairro='$bairro', cidade='$cidade', estado='$estado', 
        cep='$cep', escolaridade='$escolaridade', sexo='$sexo', turno='$turno', cpf='$cpf', rg='$rg' WHERE id_funcionario=$id";
        if ($conn->query($sql) === TRUE) {
            $mensagem = "<div id='feedback' class='feedback-msg success-msg'>Usuário editado com sucesso!</div>";
        } else {
            $mensagem = "<div id='feedback' class='feedback-msg error-msg'>Erro ao editar usuário: " . $conn->error . "</div>";
        }
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
}

$sql = "SELECT id_funcionario, nome_func, email, data_nasc, numero, complemento, rua, bairro, cidade, estado, cep, escolaridade, sexo, turno, cpf, rg FROM funcionarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="cadastrofuncionarios.css">
    <link rel="stylesheet" href="tabela.resgate.css">
    <link rel="stylesheet" href="../../Geral/header.css">
    <link rel="stylesheet" href="../../Geral/global.css">
    li
    <link rel="stylesheet" href="../logged_in_user.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" defer integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>

    <script src="../../Geral/header.js" defer></script>
    <script src="../logged_in_user.js" defer></script>
    <script src="cadastro_funcionario.js" defer></script>
    <script src="cpf_cep_rg.js" defer></script>
</head>
<body>
<header>
    <div class="container">
        <nav class="nav-menu">
            <div> <a href= "../user_logado.php" class="logo">PDA</a></div>

            <div class="size-text">
                <button class="button-size_text" id="increase-font">A+</button>
                <button class="button-size_text" id="decrease-font">A-</button>
            </div> <!-- class="size-text" FIM -->
                
            <div><i id="mode-icon" class="fa-solid fa-moon icons"></i></div>

            <button class="user_logado">
                <i class="fa-solid fa-user"></i>
                <?php echo 'Ola, ' . $name; ?> 
                <div id="logado"></div>
            </button> <!-- {class="user_logado" > END} -->
                
            <div class="menu-logado">
                <a class="editar-perfil" href="../editarPerfil/editarPerfil.html.php">
                    <i class="fa-solid fa-gear"></i>
                    <div class="cf_text">
                        <h6 class="cf_title">Editar Perfil</h6>
                        <p class="cf_subtitle">Atualize suas credenciais</p>
                    </div> <!-- class="cf_text" > END -->
                </a> <!-- {class="nome_empresa" > END} -->
            
                <a class="cadastrar_funcionario" href="cadastrofuncionarios.php">
                    <i class="fa-solid fa-wrench"></i>
                    <div class="cf_text">
                        <h6 class="cf_title">Cadastro de funcionários</h6>
                        <p class="cf_subtitle">Cadastre seus funcionários no projeto</p>
                    </div> <!-- class="cf_text" > END -->
                </a> <!-- {class="cadastrar_funcionario cdf" > END} -->
            
                <a class="leave" href="../logout.php">
                    <img class="image_leave" src="../../../images/login_user/logout.png" alt="logout" />
                    <h6 class="text_leave">Sair da conta</h6>
                </a> <!-- {class="leave" > END} -->
            </div> <!-- {class="menu-logado" > END} -->
            
        </nav> <!-- {class="nav-menu" > END} -->
    </div> <!-- {class="container" > END} -->
</header>


<main>
    <div class="container-editar">
    
        <form method="post">
        <div class="form-section">
        <h2>Cadastre um funcionário</h2>
            <input type="hidden" name="id_funcionario" id="id_funcionario">
                
                
            <div class="input_group">
                <div class="container_input">
                    <label for="nome">Nome do Aluno:</label>
                    <input type="text" id="nome_func" maxlength="50" name="nome_func" class="input-field" placeholder="Nome" >
                    <span class="spans"></span> 
                </div>


                <div class="container_input">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="input-field" placeholder="email" required>
                    <span class="spans"></span> 
                </div>
            </div>

              
            
            <div class="input_group">
                <div class="container_input">
                        <label for="nascimento">Data de Nascimento:</label>
                        <input type="date" name="data_nasc" id="data_nasc" class="input-field" placeholder="Data de Nascimento" required>
                        <span class="spans"></span> 
                </div>
            
                <div class="container_input">
                        <label for="sexo">Gênero:</label>
                        <select name="sexo" id="sexo">
                            <option value="" selected>Selecione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <span class="spans"></span>
                    </div> <!-- {class="container_input" > END} -->
            </div>

            <div class="input_group">
                <div class="container_input">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="input-field" placeholder="CPF" required>
                    <span class="spans"></span> 
                </div>


                <div class="container_input">
                    <label for="rg">RG:</label>
                    <input type="text" name="rg" id="rg" class="input-field" placeholder="RG" required>
                    <span class="spans"></span> 
                </div>
            </div>  

            <div class="input_group">
                <div class="container_input">
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" id="cep" class="input-field" placeholder="CEP" required onblur="buscaCep()">
                    <span class="spans"></span> 
                </div>
            
                <div class="container_input">
                    <label for="estado">Estado:</label>
                    <input type="text" name="estado" id="estado" class="input-field" placeholder="Estado" required>
                    <span class="spans"></span> 
                </div>

                <div class="container_input">
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="input-field" placeholder="Cidade" required>
                    <span class="spans"></span> 
                </div>
            </div>

            <div class="input_group">
            <div class="container_input">
                    <label for="bairro">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" class="input-field" placeholder="Bairro" required>
                    <span class="spans"></span> 
                </div>
                <div class="container_input">
                    <label for="rua">Rua:</label>
                    <input type="text" name="rua" id="rua" class="input-field" placeholder="Rua" required>
                    <span class="spans"></span> 
                </div>
            </div>

            <div class="input_group">
                <div class="container_input">
                    <label for="numero">Número:</label>
                    <input type="text" name="numero" id="numero" class="input-field" placeholder="Número" required>
                    <span class="spans"></span> 
                </div>

                <div class="container_input">
                    <label for="complemento">Complemento:</label>
                    <input type="text" name="complemento" id="complemento" class="input-field" placeholder="Complemento">
                    <span class="spans"></span>       
                </div>
            </div>


            <div class="input_group">
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
                </div>
            

                <div id="successMessage"></div>

                <div class="buttons">
                <button type="submit" name="adicionar" class="button">Adicionar</button>
                <button type="submit" name="editar" class="button">Salvar Edição</button>
                </div>

                </div>
                </div>
            </form>
            

        <div class="tabela-container">
        <h2>Editar ou Excluir Usuário</h2>
        <?php
        // Exibe a mensagem de sucesso ou erro
        echo $mensagem;
        ?>

        <!-- Área com rolagem para a tabela de funcionários -->
    
            <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>email</th>
                <th>Ações</th>
            </tr>
            
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id_funcionario"] . "</td>
                            <td>" . $row["nome_func"] . "</td>
                            <td>" . date("d/m/Y", strtotime($row['data_nasc'])) . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>
                                <button class='button' onclick=\"editarUsuario(" . $row["id_funcionario"] . ", '" . $row["nome_func"] . "', '" . $row["email"] . "', '" . $row["data_nasc"] . "', '" . $row["cpf"] . "', '" . $row["rg"] . "', '" . $row["sexo"] . "', '" . $row["escolaridade"] . "', '" . $row["turno"] . "', '" . $row["cep"] . "', '" . $row["estado"] . "', '" . $row["cidade"] . "', '" . $row["bairro"] . "', '" . $row["rua"] . "', '" . $row["numero"] . "', '" . $row["complemento"] . "')\">Editar</button>
                                <form method='post' style='display:inline-block'>
                                    <input type='hidden' name='id' value='" . $row["id_funcionario"] . "'>
                                    <button class='button' type='submit' name='excluir' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?')\">Excluir</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='17'>Nenhum dado encontrado</td></tr>";
            }
            ?>
        </table>
        
            <form action="gerar_excel.php" method="post" class="excel">
                <button type="submit" class="button_excel">
                    <img src="./sim.png" alt="Ícone de Download" style="width:20px; height:20px; vertical-align: middle;">
                    <p> Planilha em Excel</p>
                </button>
            </form>
        </div>
    </main>


    <footer>
        <h2>Portal da alfabetização</h2>
  
        <h3>Desenvolvedores</h3>
  
        <div class="devs">
            <p>Anderson Ferreira</p>
            <p>João Perrut</p>
            <p>Pedro</p>
            <p>Mariana Herbst</p>
            <p>Taiane</p>
        </div>
      
        <p class="direitos_reservados">&copy; 2024 Todos os direitos reservados</p>
    </footer> 






<!-- Script para remover mensagens -->
<script>
        setTimeout(function () {
            const feedbacks = document.querySelectorAll('.feedback-msg');
            feedbacks.forEach(feedback => {
                feedback.style.opacity = '0';
                setTimeout(() => feedback.remove(), 500); // Remove do DOM após a transição
            });
        }, 5000); // 5 segundos
    </script>
<script>
function editarUsuario(id, nome_func, email, data_nasc, cpf, rg, sexo, escolaridade, turno, cep, estado, cidade, bairro, rua, numero, complemento) {
    // Preenche os campos com os dados do usuário
    document.getElementById('id_funcionario').value = id;
    document.getElementById('nome_func').value = nome_func;
    document.getElementById('email').value = email;
    document.getElementById('data_nasc').value = data_nasc;
    document.getElementById('cpf').value = cpf;
    document.getElementById('rg').value = rg;
    document.getElementById('sexo').value = sexo;
    document.getElementById('escolaridade').value = escolaridade;
    document.getElementById('turno').value = turno;
    document.getElementById('cep').value = cep;
    document.getElementById('estado').value = estado;
    document.getElementById('cidade').value = cidade;
    document.getElementById('bairro').value = bairro;
    document.getElementById('rua').value = rua;
    document.getElementById('numero').value = numero;
    document.getElementById('complemento').value = complemento;

   // Obter a posição da seção de formulário
   const formSection = document.querySelector('.form-section');
        const offset = formSection.offsetTop - 100; // Ajusta a rolagem 
        // Rolagem suave 
        window.scrollTo({
            top: offset,
            behavior: 'smooth'
        });
    }


</script>

</body>
</html>

<?php
$conn->close();
?>