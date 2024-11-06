$(document).ready(function() {

// INCREASE AND DECREASE FONT > BEGINNING

const maxFontSize = 12; 
// Tamanho máximo

const minFontSize = 8; 
// Tamanho mínimo

function changeFontSize(action) {


    $('html, body').each(function() {
    // Seleciona os elementos 'html' e 'body' e itera sobre eles

        let size = parseInt($(this).css('font-size'));
        // Obtém o tamanho atual da fonte em pixels

        if (action === 'aumentar' && size < maxFontSize) {
        // Verifica se a ação é 'aumentar' e se o tamanho da fonte é menor que o máximo permitido (maxFontSize)

            $(this).css('font-size', size + 1);
            // Aumenta o tamanho da fonte em 1 pixel
        } 

        else if (action === 'diminuir' && size > minFontSize) {
        // Verifica se a ação é 'diminuir' e se o tamanho da fonte é maior que o mínimo permitido (minFontSize)

            $(this).css('font-size', size - 1);
            // Diminui o tamanho da fonte em 1 pixel
        }
    });

    ignoreScroll = true;
    // Impede o scroll automático quando a função é executada    

    setTimeout(() => ignoreScroll = false, 1000);
    // Após 1 segundo (1000 ms), libera o scroll novamente definindo ignoreScroll como false
}


$('#increase-font').click(function() {
    changeFontSize('aumentar');
});

$('#decrease-font').click(function() {
    changeFontSize('diminuir');
});

// INCREASE AND DECREASE FONT > END


// DARK AND WHITE MODE > BEGINNING

const iconDL = $('#mode-icon');
const html = $('html');

iconDL.on('click', function() {
    html.toggleClass("light");
    updateSliderImages();
    
    if (iconDL.hasClass('fa-moon')) {
        iconDL.removeClass('fa-moon').addClass('fa-sun');
    } else {
        iconDL.removeClass('fa-sun').addClass('fa-moon');
    }
});



// DARK AND WHITE MODE > END

$('.container_section_four').hide();

// usuario logado
let menu_logado = $('.menu-logado');
let userLogado = JSON.parse(localStorage.getItem('userLogado'));

    // Exibe o nome do usuário logado na página
    let logado = document.querySelector('#logado');
    logado.innerHTML = 'Olá, ' + userLogado.nome;

    if (localStorage.getItem('token') != null) {
        $('#link_cadastrar').css('display', 'none');
        $('.user_logado').css('display', 'flex');
        $('#cde').hide();
        $('#cdf').show();
    }

    $('.user_logado').on('click', function() {
        
        
        if (menu_logado.css('opacity') == 0) {
            menu_logado.css({'opacity': '1', 'visibility': 'visible'});
        } else { 
            menu_logado.css({'opacity': '0','visibility': 'hidden'});
        }

    
        if ($('#arrow_icon').hasClass('fa-arrow-turn-up')) {
            $('#arrow_icon').removeClass('fa-arrow-turn-up').addClass('fa-arrow-turn-down');
        } else {
            $('#arrow_icon').removeClass('fa-arrow-turn-down').addClass('fa-arrow-turn-up');
        }
    });
    


    // Função para sair (remover token e redirecionar)
    $('#sairBtn').on('click', function() {
        localStorage.removeItem('token');
        localStorage.removeItem('userLogado');
        window.location.href = '/html/login.html';
    });

    $('.container:not(header .container, main .container_section_four)').show();
    $('.container_section_four').hide();

    $('.cdf').on('click', function() {
        menu_logado.css({'opacity': '0','visibility': 'hidden'});
        $('.container:not(header .container, main .container_section_four)').fadeOut(500, function() {
            $('.container_section_four').fadeIn(500);
            $('html, body').animate({
                scrollTop: $('#section_four').offset().top
            }, 500);
        });
    });

    $('.click-disappear').on('click', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link
        
        const target = $(this).attr('href'); // Obtém o alvo do link clicado
    
        $('.container_section_four').fadeOut(500, function() {
            // Executa após o fadeOut da seção 4
    
            $('.container:not(header .container, main .container_section_four)').fadeIn(500, function() {
                // Executa após o fadeIn das outras seções
    
                // Aguarda um pequeno tempo para garantir a finalização completa das animações
                setTimeout(() => {
                    // Verifica se o alvo existe antes de rolar
                    if ($(target).length) {
                        $('html, body').animate({
                            scrollTop: $(target).offset().top // Rola suavemente até o alvo
                        }, 800); // Duração de 800ms para a rolagem
                    }
                }, 100); // 100 milissegundos de atraso (você pode ajustar)
            });
        });
    });
    
    


});