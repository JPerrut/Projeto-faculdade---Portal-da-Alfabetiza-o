// SCROLLING LINKS > BEGINNING

$(document).ready(function() {
// Espera o DOM estar completamente carregado antes de executar o código

    const header = $('header'); 
    // Seleciona o elemento <header> e o armazena na constante

    let ignoreScroll = false; 
    // Variável para controlar se a rolagem deve ser ignorada

    
    const closeMenu = () => {
    // Função para fechar o menu mobile

        $('.menu-button').removeClass('active'); 
        // Remove a classe 'active' do botão do menu

        $('#menu').removeClass('show'); 
        // Remove a classe 'show' do menu, ocultando-o
    };

    
    const smoothNavigateTo = target => {
    // Função para navegar suavemente até um alvo específico

        closeMenu(); 
        // Fecha o menu antes de navegar

        ignoreScroll = true; 
        // Ignora rolagem durante a animação

        header.addClass('hidden'); 
        // Oculta o cabeçalho

        
        $('html, body').animate({
        // Anima a rolagem da página até a posição do alvo

            scrollTop: $(target).offset().top 
            // Define a posição de rolagem

        }, 800, () => setTimeout(() => ignoreScroll = false, 300)); 
        // Permite rolagem novamente após 300ms
    };

    
    $('.click-disappear').on('click', function(event) {
    // Adiciona um evento de clique a todos os links que devem ocultar o menu

        event.preventDefault(); 
        // Impede o comportamento padrão do link

        smoothNavigateTo(this.getAttribute('href')); 
        // Chama a função de navegação suave
    });

    let lastScrollTop = 0; 
    // Variável para armazenar a última posição do scroll
    
    $(window).on('scroll', function() {
    // Evento de scroll para mostrar ou ocultar o cabeçalho

        if (ignoreScroll) return; 
        // Ignora a rolagem se estiver em navegação suave

        const scrollTop = $(this).scrollTop(); 
        // Obtém a posição atual do scroll

        header.toggleClass('hidden', scrollTop > lastScrollTop); 
        // Adiciona ou remove a classe 'hidden' com base na direção do scroll

        lastScrollTop = scrollTop; 
        // Atualiza a última posição do scroll
    });

// SCROLLING LINKS > END


//  INCREASE AND DECREASE FONT > BEGINNING

const maxFontSize = 12; 
// Tamanho máximo

const minFontSize = 8; 
// Tamanho mínimo

function changeFontSize(action) {
    $('html, body').each(function() {
        let size = parseInt($(this).css('font-size'));
        if (action === 'aumentar' && size < maxFontSize) {
            $(this).css('font-size', size + 1);
        } else if (action === 'diminuir' && size > minFontSize) {
            $(this).css('font-size', size - 1);
        }
    });
    ignoreScroll = true;
    setTimeout(() => ignoreScroll = false, 1000);
}

$('#increase-font').click(function() {
    changeFontSize('aumentar');
});

$('#decrease-font').click(function() {
    changeFontSize('diminuir');
});


//  INCREASE AND DECREASE FONT > END




// HEADER > BEGINNING

const btnMenu = document.querySelector('.menu-button');
const menu = document.getElementById('menu');
const iconDL = document.getElementById('mode-icon')
const html = document.documentElement


    // BUTTON MENU > BEGINNING

btnMenu.addEventListener('click', function(e) {
    this.classList.toggle('active');
    menu.classList.toggle('show');
    e.stopPropagation();
});

    // BUTTON MENU > END


    // DARK AND WHITE MODE > BEGINNING

iconDL.addEventListener('click', function() {
    html.classList.toggle("light")
    updateSliderImages();
    
    if (iconDL.classList.contains('fa-moon')) {
        iconDL.classList.remove('fa-moon');
        iconDL.classList.add('fa-sun');
    }
    else {
        iconDL.classList.remove('fa-sun');
        iconDL.classList.add('fa-moon');
    }
});

    // DARK AND WHITE MODE > END


    // CLOSE THE MENU IF YOU CLICK OUTSIDE > BEGINNING

document.addEventListener('click', function(e) {
        const clickMenu = menu.contains(e.target);
        const clickButton = btnMenu.contains(e.target);

        if (!clickMenu && !clickButton) {
            menu.classList.remove('show');
            btnMenu.classList.remove('active')
        }
});

    // CLOSE THE MENU IF YOU CLICK OUTSIDE > END

    // CHECK THE SCREEN SIZE AND TOGGLE THE MENU > BEGINNING

function updateSliderImages() {
    if (this.window.innerWidth < 660) {
        if (html.classList.contains('light')) {
            this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-mobile/slide_1_mobile_white.png";
            this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-mobile/slide_2_mobile_white.png";
            this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-mobile/slide_3_mobile_white.png";
            this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-mobile/slide_4_mobile_white.png";
        } else {
            this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-mobile/slide_1_mobile_black.png";
            this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-mobile/slide_2_mobile_black.png";
            this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-mobile/slide_3_mobile_black.png";
            this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-mobile/slide_4_mobile_black.png";
        }

    } else if (this.window.innerWidth > 660) {

         if (html.classList.contains('light')) {
            this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-desktop/slide_1_desktop_white.png";
            this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-desktop/slide_2_desktop_white.png";
            this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-desktop/slide_3_desktop_white.png";
            this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-desktop/slide_4_desktop_white.png";
         }
         else {
            this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-desktop/slide_1_desktop_black.png";
            this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-desktop/slide_2_desktop_black.png";
            this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-desktop/slide_3_desktop_black.png";
            this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-desktop/slide_4_desktop_black.png";
         }

    }
}

window.addEventListener('resize', updateSliderImages);
document.addEventListener('DOMContentLoaded', updateSliderImages);

updateSliderImages();

window.addEventListener('resize', updateSliderImages);

    // CHECK THE SCREEN SIZE AND TOGGLE THE MENU > END  

// HEADER > END

// SECTION > TWO > BEGINNING

    // SLIDESHOW > BEGINNING

$(function() {
    // Função anônima para o código só executar após todo o documento carregar.

    var direction_Slide = 0, slides = $('.chamada-single'), autoResumeDelay;
    // autoResumeDelay: armazena o ID do temporizador de retomar a troca automática.

    function initSlider() {
    // inicializa o slideshow.

        slides.hide().eq(direction_Slide).show(); 
        // Exibe o primeiro slide e esconde os outros.
    }

    function changeSlide() {
    // inicia a troca automatica de slides.

        autoChangeInterval = setInterval(() => navigateSlide('next'), delay = 7000);
        // usa o setInterval para chamar a função navigatslide a cada 3 segundos usando a direção next.
    }

    function navigateSlide(direction) {
        // controla a navegação entre os slides se next ou prev.
    
        var currentSlide = slides.eq(direction_Slide); 
        // Seleciona o slide atual

        currentSlide.animate({ opacity: 0 }, 200, function() { 
        // Anima a opacidade para 0

            currentSlide.hide(); 
            // Oculta o slide após a animação

            direction_Slide = (direction_Slide + (direction === 'next' ? 1 : -1) + slides.length) % slides.length;
            // Atualiza a direção do slide com base na direção da navegação.
            
            var nextSlide = slides.eq(direction_Slide); 
            // Seleciona o próximo slide

            nextSlide.css({ opacity: 0 }).show().animate({ opacity: 1 }, 200); 
            // Define a opacidade do próximo slide como 0 
            // Mostra o próximo slide
            // Anima a opacidade do próximo slide para 1
        });
    
        resetAndResumeAutoChange(); // Reinicia a troca automática.
    }
    

    function resetAndResumeAutoChange() {
        // Pausa a troca automática e reinicia após um atraso.

        clearInterval(autoChangeInterval); 
        // Para a troca automática.

        clearTimeout(autoResumeDelay); 
        // Limpa o temporizador anterior.

        autoResumeDelay = setTimeout(changeSlide, 2000); 
        // Aguarda 2 segundos para retomar a troca automática.

    }

    initSlider(); changeSlide();

    $('.next').on('click', () => navigateSlide('next'));
    // chama a função resetAndResumeAutoChange e passa para o próximo slide

    $('.prev').on('click', () => navigateSlide('prev'));
    // chama a função resetAndResumeAutoChange e volta para o slide anterior

}); //function() > END

    // SLIDESHOW > END

// SECTION > TWO > END

// SECTION > THREE > BEGINNING


$('.cell').mask('(00) 00000-0000'); 


// Seleciona o elemento com ID "name" do documento HTML
const inputName = document.querySelector("#name");

// Anexa um ouvinte de evento "keypress" ao campo de entrada
inputName.addEventListener("keypress", function(e) {
  
// Chama a função checkChar para validar o caractere pressionado
  if(!checkChar(e)) {
// Se checkChar retornar falso (ou seja, o caractere não é uma letra)
// Prevenir o comportamento padrão (inserir o caractere)
    e.preventDefault();
  }

});

// Função para verificar se o caractere pressionado é uma letra
function checkChar(e) {
  // Extrai o código de caractere do objeto de evento

  const char = String.fromCharCode(e.keyCode);
  // Define um padrão de expressão regular para letras (incluindo acentuadas)
  const pattern = '[ A-Za-zÀ-ú]';

  // Verifica se o caractere corresponde ao padrão
  if(char.match(pattern)) {
    // Se for uma letra, retorne true (permitir o caractere)
    return true;
  }
}

document.getElementById('contactForm').addEventListener('submit', function(e) {
// Adiciona um evento ao formulário quando ele é submetido

    e.preventDefault(); 
    // Impede o envio padrão do formulário
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const cell = document.getElementById('cell').value;
    const message = document.getElementById('message').value; 
    // Obtém os valores dos campos do formulário

    let isValid = true; 
    // Variável para verificar se o formulário é válido

    // NAME FIELD VALIDATION > BEGINNING

    if (name.length < 3) {
        document.getElementById('nameError').textContent = 'Por favor, preencha seu nome.'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido
    } else {
        document.getElementById('nameError').textContent = ''; 
        // Limpa a mensagem de erro
    }

    // NAME FIELD VALIDATION > END

    // EMAIL FIELD VALIDATION > BEGINNING

    const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w*)*\.\w+([-.]\w+)*$/; 
    // Regex para validação de email

    if (email === '') {
        document.getElementById('emailError').textContent = 'Por favor, preencha seu email.'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido

    } else if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Por favor, insira um email válido.'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido

    } else {
        document.getElementById('emailError').textContent = ''; 
        // Limpa a mensagem de erro
    }

    // EMAIL FIELD VALIDATION > END

    // CELL FIELD VALIDATION > BEGINNING

    if (cell === '') {
        document.getElementById('cellError').textContent = 'Por favor, preencha com o número do seu celular.'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido

    } else if (cell.length < 15) {
        document.getElementById('cellError').textContent = 'Por favor, insira um número válido'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido

    } else {
        document.getElementById('cellError').textContent = ''; 
        // Limpa a mensagem de erro
    }

    // CELL FIELD VALIDATION > END

    // VALIDATION OF THE MESSAGE FIELD > BEGINNING

    if (message === '') {
        document.getElementById('messageError').textContent = 'Por favor, preencha a mensagem.'; 
        // Mensagem de erro

        isValid = false; 
        // Marca o formulário como inválido

    } else {
        document.getElementById('messageError').textContent = ''; 
        // Limpa a mensagem de erro
    }

    // VALIDATION OF THE MESSAGE FIELD > END

    if (isValid) {
    // Se todos os campos forem válidos, exibe a mensagem de sucesso e reseta o formulário

        document.getElementById('contactForm').reset(); 
        // Reseta o formulário

        document.getElementById('formSent').textContent = 'Formulário enviado com sucesso!'; 
        // Mensagem de sucesso

        setTimeout(function() {
            // Remove a mensagem de sucesso após 3 segundos

            document.getElementById('formSent').textContent = ''; 
            // Limpa a mensagem de sucesso
            
        }, 3000);
    }
});

});

// SECTION > THREE > END