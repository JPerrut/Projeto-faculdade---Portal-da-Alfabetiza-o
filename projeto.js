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

        this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-mobile/slide_1_mobile.png";
        this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-mobile/slide_2_mobile.png";
        this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-mobile/slide_3_mobile.png";
        this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-mobile/slide_4_mobile.png";
    } else if (this.window.innerWidth > 660) {
        this.document.querySelector('.slider1').src = "images/main_section_two/slideshow-desktop/slide_1_desktop.png";
        this.document.querySelector('.slider2').src = "images/main_section_two/slideshow-desktop/slide_2_desktop.png";
        this.document.querySelector('.slider3').src = "images/main_section_two/slideshow-desktop/slide_3_desktop.png";
        this.document.querySelector('.slider4').src = "images/main_section_two/slideshow-desktop/slide_4_desktop.png";
    }                                                           
}

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

$(document).ready(function() {
    $('.cell').mask('(00) 00000-0000'); 
});

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
    e.preventDefault();


const name = document.getElementById('name').value;
const email = document.getElementById('email').value;
const cell = document.getElementById('cell').value;
const message = document.getElementById('message').value; 

let isValid = true;

if(name.length < 3) {document.getElementById('nameError').textContent = 'Por favor, preencha seu nome.';
    isValid = false;
} else {
    document.getElementById('nameError').textContent = '';
}

const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w*)*\.\w+([-.]\w+)*$/;
if(email === '') {
    document.getElementById('emailError').textContent = 'Por favor, preencha seu email.';
    isValid = false;
} 
else if (!emailRegex.test(email)) {
    document.getElementById('emailError').textContent = 'Por favor, insira um email válido.';
    isValid = false;
}
else {
    document.getElementById('emailError').textContent = '';
}


if (cell === '') {
    document.getElementById('cellError').textContent = 'Por favor, preencha com o número do seu celular.';
    isValid = false;
}
else if (cell.length < 15) {
    document.getElementById('cellError').textContent = 'Por favor, insira um número válido'
    isValid = false;
} 
else {
    document.getElementById('cellError').textContent = '';
}

// Validação do campo Mensagem
if (message === '') {
    document.getElementById('messageError').textContent = 'Por favor, preencha a mensagem.';
    isValid = false;
} else {
    document.getElementById('messageError').textContent = '';
}

// Se todos os campos forem válidos, exibe a mensagem de sucesso e reseta o formulário
if (isValid) {
    document.getElementById('contactForm').reset(); // Limpa o formulário
    document.getElementById('formSent').textContent = 'Formulário enviado com sucesso!'
    setTimeout(function() {
        document.getElementById('formSent').textContent = '';
    }, 3000);
}
});

// SECTION > THREE > END