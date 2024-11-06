$(document).ready(function () {
    // Evento ao submeter o formulário de login
    $('#loginForm').on('submit', function (e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        let email = $('#loginEmail').val();
        let senha = $('#loginPassword').val();

        // Verifica se o email ou a senha estão vazios
        if (email === '' || senha === '') {
            $('#errorMessage').text('Usuário ou senha incorretos').show();
            return;
        }

        // Recupera os dados do localStorage
        let listaUser = JSON.parse(localStorage.getItem('listaUser')) || [];
        let userValid = { nome: '', email: '', senha: '' };

        // Procura pelo usuário com o email e senha fornecidos
        listaUser.forEach((item) => {
            if (email === item.emailCad && senha === item.senhaCad) {
                userValid = { nome: item.nomeCad, email: item.emailCad, senha: item.senhaCad };
            }
        });

        // Verifica se o usuário é válido
        if (email === userValid.email && senha === userValid.senha) {
            let token = Math.random().toString(16).substring(2) + Math.random().toString(16).substring(2);
            localStorage.setItem('token', token); // Armazena um token no localStorage
            localStorage.setItem('userLogado', JSON.stringify(userValid)); // Armazena os dados do usuário logado
            window.location.href = '/html/index.html'; // Redireciona para a página inicial
        } else {
            $('#errorMessage').text('Usuário ou senha incorretos').show(); // Mensagem de erro se as credenciais forem inválidas
        }
    });

    // Função para limpar o formulário de login
    $('#clearLogin').on('click', function () {
        $('#loginForm')[0].reset(); // Limpa todos os inputs do formulário de login
        $('#errorMessage').text('').hide(); // Limpa a mensagem de erro e esconde
        $('#loginMessage').text('').hide(); // Limpa a mensagem de sucesso e esconde
    });
});
