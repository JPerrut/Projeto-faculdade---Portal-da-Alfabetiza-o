<?php
include 'dashboard.php'; //Conexao

?>
<!DOCTYPE html>
<html lang="pt-br" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css_index_html/style.css">
    <link rel="stylesheet" href="./css_index_html/cadastro_func.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>
    <script src="/js_index_html/script.js" defer></script>
    <script src="/js_index_html/slideshow.js" defer></script>
    <script src="/js_index_html/menu.js" defer></script>
    <script src="/js_index_html/contatenos.js" defer></script>
    <script src="/js_index_html/cadastro_funcionario.js" defer></script>
    <script src="/js_index_html/cpf_cep.js" defer></script>

    <title>Portal da alfabetização</title>
</head>
<body>
    <header>
        <div class="container">
            <nav class="nav-menu">
                <div> <a href= "index.html" class="logo">PDA</a></div>

                <div class="size-text">
                    <button class="button-size_text" id="increase-font">A+</button>
                    <button class="button-size_text" id="decrease-font">A-</button>
                </div> <!-- class="size-text" FIM -->
                
                <div><i id="mode-icon" class="fa-solid fa-moon icons"></i></div>

                <ul id="menu" class="menu">
                    <li><a href="#move-start"   class="click-disappear">Inicio</a></li>
                    <li><a href="#move-differential"   class="click-disappear">Diferencial</a></li>
                    <li><a href="#move-about"   class="click-disappear">Sobre</a></li>
                    <li><a href="#move-contact" class="click-disappear">Contato</a></li>
                    <li class="division_bar"></li>
                    <li class="perfil-login" id="link_cadastrar">
                        <div><a href="cadastro.html">Cadastrar</a></div>
                        <div><a href="/html/login.html">Logar</a></div>
                        <div><a href="logout.php">Deslogar</a></div>
                    </li> <!-- class="perfil-login" FIM -->
                </ul> <!-- class="menu" FIM -->
                <button class="menu-button" ></button>
                <button class="user_logado">
                    <i class="fa-solid fa-user"></i>
                    <div id="logado"></div>
                    <i class="fa-solid fa-arrow-turn-up" id="arrow_icon"></i>
                </button>
                <div class="menu-logado">
                    <div class="nome_empresa">
                        <div class="logo">PDA</div>
                    </div>
                    <button class="cadastrar_funcionario cdf">
                        <i class="fa-solid fa-wrench"></i>
                        <div class="cf_text">
                            <h6 class="cf_title">Cadastro de funcionários</h6>
                            <p class="cf_subtitle">Cadastre seus funcionarios no projeto</p>
                        </div>
                    </button>
                    <button class="leave" id="sairBtn">
                        <img src="/images/login_user/logout.png" alt="logout" class="image_leave">
                        <h6 class="text_leave">Sair da conta</h6>
                    </button>
                </div>
            </nav> <!-- class="nav-menu" FIM -->
        </div> <!-- class="container" FIM -->
    </header>

    <main>
        <!-- class="container" > BEGINNING -->
        <div class="container">

            <div class="container-title-border-main">
                <h1 class="title_main" id="move-start">portal da alfabetização</h1>
                <div class="border-title-main"></div>
            </div>

            <!-- SECTION_ONE > BEGINNING -->
            <section>
                <div class="image_main"></div>

                <!-- class="box_text_main" > BEGINNING -->
                <div class="box_text_main">
                    <h3 class="box_text_main_title">Aprender é Transformar</h3>
                    <p class="box_text_main_paragraph">Descubra o prazer da leitura e escrita com uma abordagem simples e prática, criada especialmente para você.</p>
                    <a href="/html/Cadastro.html" class="box_text_main_button" id="cde">Cadastre sua empresa</a>
                    <button class="box_text_main_button cdf" id="cdf">Cadastre o seu funcionário</button>
                </div>
                <!-- class="box_text_main" > END -->

            </section>
            <!-- SECTION_ONE > END -->

            <div class="container-title-border-main">      
            <h1 class="title_main" id="move-differential">Diferencial</h1>
                <div class="border-title-main"></div>
            </div>

            <!-- SECTION_TWO > BEGINNING -->
            <section class="section_two">
                <div class="slider-outer">
                    <div class="prev button" alt="Prev"></div>
                    <div class="slider-inner">
                        <img class="chamada-single slider1" src="/images/main_section_two/slideshow-desktop/slide_1_desktop_black.png">
                        <img class="chamada-single slider2" src="/images/main_section_two/slideshow-desktop/slide_2_desktop_black.png">
                        <img class="chamada-single slider3" src="/images/main_section_two/slideshow-desktop/slide_3_desktop_black.png">
                        <img class="chamada-single slider4" src="/images/main_section_two/slideshow-desktop/slide_4_desktop_black.png">
                    </div>
                    <div class="next button" alt="Next"></div>
                </div>
            </section>
            <!-- SECTION_TWO > END -->

            <div class="container-title-border-main">
                <h1 class="title_main" id="move-about">Sobre Nós</h1>
                <div class="border-title-main"></div>
            </div>
                
            <section>
                <!-- class="box_text_main" > BEGINNING -->
                <div class="box_text_main1">
                    <p class="box_text_main_paragraph1">Somos cinco empreendedores dedicados a ajudar trabalhadores mais velhos que ainda enfrentam o analfabetismo, apesar de estarem empregados. A ideia surgiu quando um de nós percebeu essa necessidade em sua própria empresa.<br><br>

                        Conectamos empresas que precisam alfabetizar seus funcionários com a prefeitura local, agilizando o acesso a programas educacionais. Nosso propósito é melhorar a qualidade de vida desses trabalhadores e apoiar empresas no desenvolvimento de seus colaboradores.<br><br>
                        
                        Juntos, estamos construindo um futuro mais justo e inclusivo, onde a educação básica chega a todos, independentemente da idade ou circunstância.<br><br>
                </div>

                <div class="sobre">
                    <img src="/images/main_section_one/sobre.png" alt="">
                </div>
                <!-- class="box_text_main" > END -->

            </section>
                

            <div class="container-title-border-main">
                <h1 class="title_main" id="move-contact">Contate-nos</h1>
                <div class="border-title-main"></div>
            </div>


            <!-- SECTION_THREE > BEGINNING -->
            <section class="section_three">

                <!-- FORM > BEGINNING -->
                <form action="#" method="post" id="contactForm" novalidate>
                    
                    <div class="box_input">
                        <input type="text" id="name" name="name" placeholder="" maxlength="60">
                        <label>Nome:</label>
                        <span id="nameError" class="error"></span>
                    </div>

                    <div class="box_input">
                        <input type="email" id="email" name="email" placeholder="" >
                        <label>Email:</label>
                        <span id="emailError" class="error"></span>
                    </div>

                    <div class="box_input">
                        <input type="text" id="cell" class="cell" name="cell" placeholder="" >
                        <label>Celular:</label>
                        <span id="cellError" class="error"></span>
                    </div>
                    <div class="box_input">
                        <textarea id="message" name="message" placeholder="" rows="4" cols="50" maxlength="300"></textarea>
                        <label>Mensagem:</label>
                        <span id="messageError" class="error"></span>
                    </div>

                    <input type="submit" value="Enviar" id="submit" name="submit">
                    <span id="formSent" class="formSent"></span>
                </form>
                <!-- FORM > END -->

            </section>
            <!-- SECTION_THREE > END -->

        </div>
        <!-- class="container" > END -->

        <div class="container container_section_four">
            <section class="section_four" id="section_four">
                <form action="cadastrar_func.php" id="form" name="form" method="POST" class="formFunc">
                    <h1>Cadastre um funcionário</h1>
            
                    <div class="input_group">
                        <div class="container_input">
                            <label for="nome_funcionario">Nome do Funcionário:</label>
                            <input type="text" name="nome_funcionario" maxlength="80" id="nome_funcionario" placeholder="Digite o nome completo do funcionário">
                            <span class="spans"></span>
                        </div>
                
                        <div class="container_input">
                            <label for="rg">RG:</label>
                            <input type="text" name="rg" id="rg" placeholder="Digite o RG do funcionário">
                            <span class="spans"></span>
                        </div>
                
                        <div class="container_input">
                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF do funcionário">
                            <span class="spans"></span>
                        </div>

                        <div class="container_input">
                            <label for="cpf">Email:</label>
                            <input type="text" name="email" id="email" placeholder="Digite o email do funcionário">
                            <span class="spans"></span>
                        </div>
                    </div>
            
                    <div class="input_group">
                        <div class="container_input">
                            <label for="data_nasc">Data de Nascimento:</label>
                            <input type="text" name="data_nasc" id="data_nasc" placeholder="Digite a data de nascimento (DD/MM/AAAA)" >
                            <span class="spans"></span>
                        </div>

                        <div class="container_input">
                            <label for="turno">Turno Disponível:</label>
                            <select name="turno" id="turno">
                                <option value="" selected>Selecione</option>
                                <option value="Manhã">Manhã</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noite">Noite</option>
                            </select>
                            <span class="spans"></span>
                        </div>
            
                        <div class="container_input">
                            <label for="grau_escolaridade">Grau de Escolaridade:</label>
                            <select name="grau_escolaridade" id="grau_escolaridade">
                                <option value="" selected>Selecione</option>
                                <option value="Analfabeto">Analfabeto</option>
                                <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                            </select>
                            <span class="spans"></span>
                        </div>
                    </div>

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
                        </div>
                        
                        <div class="container_input">
                            <label for="cep">CEP:</label>
                            <input type="text" name="cep" id="cep" placeholder="Digite o CEP do funcionário">
                            <span class="spans"></span>
                        </div>

                        <div class="container_input">
                            <label for="estado">Estado:</label>
                            <input type="text" name="estado" id="estado" placeholder="Digite o estado" >
                            <span class="spans"></span>
                        </div>
                    </div>

                    <div class="input_group">
                        <div class="container_input">
                            <label for="cidade">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade" >
                            <span class="spans"></span>
                        </div>

                        <div class="container_input">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" placeholder="Digite o bairro" >
                            <span class="spans"></span>
                        </div>

                        <div class="container_input">
                            <label for="rua">Rua:</label>
                            <input type="text" name="rua" id="rua" placeholder="Digite o nome da rua" >
                            <span class="spans"></span>
                        </div>
                    </div>
            
                    <div class="input_group">
                        <div class="container_input">
                            <label for="numero">Número:</label>
                            <input type="text" name="numero" id="numero" placeholder="Digite o número" >
                            <span class="spans"></span>
                        </div>
            
                        <div class="container_input">
                            <label for="complemento">Complemento:</label>
                            <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento (opcional)">
                            <span class="spans"></span>
                        </div>
                    </div>
            
                    <div id="successMessage"></div>
            
                    <div class="buttons">
                        
                        <input type="submit" name="cadastrar" id="submitBtn">
                        <button type="button" id="clearBtn">Limpar</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    

    <footer>
        <h2>Portal da alfabetização</h2>
        
        <nav>
          <ul>
            <li>
                <a href="#move-start"   class="click-disappear">Inicio</a></li>
                <li><a href="#move-differential"   class="click-disappear">Diferencial</a></li>
                <li><a href="#move-about"   class="click-disappear">Sobre</a></li>
                <li><a href="#move-contact" class="click-disappear">Contato</a></li>
          </ul>
        </nav>
      
        <div class="devs">
            <h3>Desenvolvedores</h3>

            <p>Anderson Ferreira</p>
            <p>João Perrut</p>
            <p>Pedro</p>
            <p>Mariana Herbst</p>
            <p>Taiane</p>
        </div>
      
        <p>&copy; 2024 Todos os direitos reservados</p>
      </footer>
      
      
</body>
</html>

