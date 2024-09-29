const btnMenu = document.querySelector('.menu-button');
const menu = document.getElementById('menu');
const iconDL = document.getElementById('mode-icon')
const html = document.documentElement


// BUTTON MENU

btnMenu.addEventListener('click', function(e) {
    this.classList.toggle('active');
    menu.classList.toggle('show');
    e.stopPropagation();
});

// BUTTON MENU > FIM


// DARK AND WHITE MODE

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

// DARK AND WHITE MODE > FIM


// CLOSE THE MENU IF YOU CLICK OUTSIDE

document.addEventListener('click', function(e) {
        const clickMenu = menu.contains(e.target);
        const clickButton = btnMenu.contains(e.target);

        if (!clickMenu && !clickButton) {
            menu.classList.remove('show');
            btnMenu.classList.remove('active')
        }
});

// CLOSE THE MENU IF YOU CLICK OUTSIDE > FIM

// CHECK THE SCREEN SIZE AND TOGGLE THE MENU

window.addEventListener('resize', function() {
    if (this.window.innerWidth > 768) {
        menu.classList.remove('show');
        btnMenu.classList.remove('active')
    }
})

// CHECK THE SCREEN SIZE AND TOGGLE THE MENU > FIM



