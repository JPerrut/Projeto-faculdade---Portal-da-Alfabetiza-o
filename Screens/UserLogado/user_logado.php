<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PBD/conexao.php';
// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: /PBD/Screens/Login/login.html");
    exit();
}

// Verifica se o usuário é administrador
$is_admin = $_SESSION['is_admin'] ?? 0;

// Carrega informações do usuário
//$nome_usuario = htmlspecialchars($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="pt-br" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/style.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/section_1_one.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/section_2_two.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/section_3_three.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/section_4_four.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/header.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/main.css">
    <link rel="stylesheet" href="/PBD/Screens/Homepage/Homepage - CSS/footer.css">
    <link rel="stylesheet" href="./logged_in_user.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/slideshow.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/script.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/menu.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/contatenos.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/cadastro_funcionario.js" defer></script>
    <script src="/PBD/Screens/Homepage/Homepage - JS/cpf_cep.js" defer></script>
    <script src="./logged_in_user.js" defer></script>

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
                <?php if ($is_admin): ?>
        <!-- Conteúdo para administradores -->
        <h2>Painel de Administração</h2>
        <ul>
            <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
            <li><a href="relatorios.php">Relatórios</a></li>
        </ul>
                <?php else: ?>
                    <ul id="menu" class="menu">
                        <li><a href="#move-start"   class="click-disappear">Inicio</a></li>
                        <li><a href="#move-differential"   class="click-disappear">Diferencial</a></li>
                        <li><a href="#move-about"   class="click-disappear">Sobre</a></li>
                        <li><a href="#move-contact" class="click-disappear">Contato</a></li>
                        <li class="division_bar"></li>
                    </ul> <!-- class="menu" FIM -->
                    <button class="menu-button" ></button>

                    <button class="user_logado">
                        <i class="fa-solid fa-user"></i>
                        <div id="logado"></div>
                    </button> <!-- {class="user_logado" > END} -->
                    
                    <div class="menu-logado">
                        <a class="editar-perfil" href="/perfilEdit">
                            <i class="fa-solid fa-gear"></i>
                            <div class="cf_text">
                                <h6 class="cf_title">Editar Perfil</h6>
                                <p class="cf_subtitle">Atualize suas credenciais</p>
                            </div> <!-- class="cf_text" > END -->
                        </a> <!-- {class="nome_empresa" > END} -->
                    
                        <a class="cadastrar_funcionario" href="../UserLogadoCadastrofunc/editar.php">
                            <i class="fa-solid fa-wrench"></i>
                            <div class="cf_text">
                                <h6 class="cf_title">Cadastro de funcionários</h6>
                                <p class="cf_subtitle">Cadastre seus funcionários no projeto</p>
                            </div> <!-- class="cf_text" > END -->
                        </a> <!-- {class="cadastrar_funcionario cdf" > END} -->
                    
                        <a class="leave" href="./logout.php">
                            <img class="image_leave" src="/PBD/images/login_user/logout.png" alt="logout" />
                            <h6 class="text_leave">Sair da conta</h6>
                        </a> <!-- {class="leave" > END} -->
                    </div> <!-- {class="menu-logado" > END} -->
                    
                    </nav> <!-- {class="nav-menu" > END} -->
                    </div> <!-- {class="container" > END} -->
                    
        </header>

        <main>

            <div class="container">
                <div class="container-title-border-main">
                    <h1 class="title_main" id="move-start">portal da alfabetização</h1>
                    <div class="border-title-main"></div>
                </div> <!-- class="container-title-border-main" END -->
            
                <!-- =======================
                    SECTION_ONE > BEGINNING 
                    ======================= -->
                <section>
                    <div class="image_main"></div>
            
                    <div class="box_text_main">
                        <h3 class="box_text_main_title">Aprender é Transformar</h3>
                        <p class="box_text_main_paragraph">Descubra o prazer da leitura e escrita com uma abordagem 
                        simples e prática, criada especialmente para você.</p>
                        <a class="box_text_main_button" id="cdf" href="/cadastroFunc">Cadastre o seu funcionário</a>
                    </div> <!-- class="box_text_main" END -->
                </section>
                <!-- =================
                    SECTION_ONE > END 
                    ================= -->
            
                <div class="container-title-border-main">      
                    <h1 class="title_main" id="move-differential">Diferencial</h1>
                    <div class="border-title-main"></div>
                </div> <!-- class="container-title-border-main" END -->
            
                <!-- =======================
                    SECTION_TWO > BEGINNING 
                    ======================= -->
                <section class="section_two">
                    <div class="slider-outer">
                        <div class="prev button" alt="Prev"></div>
                        <div class="slider-inner">
                            <img class="chamada-single slider1" 
                            src="/PBD/images/main_section_two/slideshow-desktop/slide_1_desktop_black.png" alt="Slide 1" />
                            <img class="chamada-single slider2" 
                            src="/PBD/images/main_section_two/slideshow-desktop/slide_2_desktop_black.png" alt="Slide 2" />
                            <img class="chamada-single slider3" 
                            src="/PBD/images/main_section_two/slideshow-desktop/slide_3_desktop_black.png" alt="Slide 3" />
                            <img class="chamada-single slider4" 
                            src="/PBD/images/main_section_two/slideshow-desktop/slide_4_desktop_black.png" alt="Slide 4" />
                        </div>
                        <div class="next button" alt="Next"></div>
                    </div>
                </section>
                <!-- =================
                    SECTION_TWO > END 
                    ================= -->
            
                <div class="container-title-border-main">
                    <h1 class="title_main" id="move-about">Sobre Nós</h1>
                    <div class="border-title-main"></div>
                </div>
            
                <!-- =========================
                    SECTION_THREE > BEGINNING 
                    ========================= -->
                <section class="section_three">
                    <div class="box_text_main2">
                        <p class="box_text_main_paragraph">Somos cinco empreendedores comprometidos em ajudar 
                            trabalhadores mais velhos que ainda são analfabetos, uma ideia que surgiu ao identificar essa 
                            necessidade dentro de uma de nossas empresas.</p>
                        <p class="box_text_main_paragraph">Conectamos empresas que precisam alfabetizar seus 
                            funcionários com a prefeitura, facilitando o acesso a programas educacionais. Nosso objetivo é 
                            melhorar a vida dos trabalhadores e apoiar o desenvolvimento dos colaboradores.</p>
                        <p class="box_text_main_paragraph">Estamos construindo um futuro mais justo e inclusivo, 
                            garantindo que a educação básica chegue a todos, independentemente da idade ou situação.</p>
                    </div> <!-- class="box_text_main" END -->
                    
                    <img src="/PBD/images/main_section_one/sobre.png" alt="" />
                </section> <!-- class="section_three" END -->
                <!-- ===================
                    SECTION_THREE > END 
                    =================== -->
            
                <div class="container-title-border-main">
                    <h1 class="title_main" id="move-contact">Contate-nos</h1>
                    <div class="border-title-main"></div>
                </div>
            
                <!-- ========================
                    SECTION_FOUR > BEGINNING 
                    ======================== -->
                <section class="section_four">
                    <form action="#" method="post" id="contactForm" novalidate>
                        <div class="box_input">
                            <input type="text" id="name" name="name" placeholder="" maxlength="60" />
                            <label>Nome:</label>
                            <span id="nameError" class="error"></span>
                        </div> <!-- class="box_input" END -->
            
                        <div class="box_input">
                            <input type="email" id="email" name="email" placeholder="" />
                            <label>Email:</label>
                            <span id="emailError" class="error"></span>
                        </div> <!-- class="box_input" END -->
            
                        <div class="box_input">
                            <input type="text" id="cell" class="cell" name="cell" placeholder="" />
                            <label>Celular:</label>
                            <span id="cellError" class="error"></span>
                        </div> <!-- class="box_input" END -->
            
                        <div class="box_input">
                            <textarea id="message" name="message" placeholder="" rows="4" cols="50" maxlength="300"></textarea>
                            <label>Mensagem:</label>
                            <span id="messageError" class="error"></span>
                        </div> <!-- class="box_input" END -->
            
                        <input type="submit" value="Enviar" id="submit" name="submit" />
                        <span id="formSent" class="formSent"></span>
                    </form> <!-- id="contactForm" END -->
                </section>
                <!-- ==================
                    SECTION_FOUR > END 
                    ================== -->
            </div> <!-- class="container" END -->        

        </main>
        <?php endif; ?>
        <footer>
            <h2>Portal da alfabetização</h2>
            
            <ul class="menu_devs">
                <li><a className="click-disappear" href="#move-start">Inicio</a></li>
                <li><a className="click-disappear" href="#move-differential">Diferencial</a></li>
                <li><a className="click-disappear" href="#move-about">Sobre</a></li>
                <li><a className="click-disappear" href="#move-contact">Contato</a></li>
            </ul>
    
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
    </body>
    </html>


    


