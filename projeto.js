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

window.addEventListener('resize', function() {
    if (this.window.innerWidth > 768) {
        menu.classList.remove('show');
        btnMenu.classList.remove('active')
    }
})

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