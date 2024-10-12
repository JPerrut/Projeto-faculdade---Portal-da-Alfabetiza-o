// SCROLLING LINKS > BEGINNING

const header = $('header');
let ignoreScroll = false;
let lastScrollTop = 0;

const closeMenu = () => {
    $('.menu-button').removeClass('active');
    $('#menu').removeClass('show');
};

const smoothNavigateTo = target => {
    closeMenu();
    ignoreScroll = true;
    header.addClass('hidden');
    
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 800, () => ignoreScroll = false);
};

$('.click-disappear').on('click', function(event) {
    event.preventDefault();
    smoothNavigateTo(this.getAttribute('href'));
});

$(window).on('scroll', () => {
    if (!ignoreScroll) {
        const scrollTop = $(this).scrollTop();
        header.toggleClass('hidden', scrollTop > lastScrollTop);
        lastScrollTop = scrollTop;
    }
});


// SCROLLING LINKS > END

const btnMenu = $('.menu-button');
const menu = $('#menu');

// BUTTON MENU > BEGINNING

btnMenu.on('click', function(e) {
    $(this).toggleClass('active');
    menu.toggleClass('show');
    e.stopPropagation();
});

// BUTTON MENU > END

// CLOSE THE MENU IF YOU CLICK OUTSIDE > BEGINNING

$(document).on('click', function(e) {
    const clickMenu = menu.is(e.target) || menu.has(e.target).length > 0;
    const clickButton = btnMenu.is(e.target) || btnMenu.has(e.target).length > 0;

    if (!clickMenu && !clickButton) {
        menu.removeClass('show');
        btnMenu.removeClass('active');
        
    }
});

// CLOSE THE MENU IF YOU CLICK OUTSIDE > END
