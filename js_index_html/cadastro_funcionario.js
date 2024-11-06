$(document).ready(function () {

    // Aplicação de máscara aos inputs
    $('#cpf').mask('000.000.000-00');
    $('#rg').mask('00.000.000-0');
    $('#data_nasc').mask('00/00/0000');
    $('#cep').mask('00000-000');
    $('#numero').mask('00000');

    $('input, select, textarea').on('keyup change', function () {
        validateField(this);
    });

    function validateField(field) {
        const value = $(field).val().trim();
        const fieldName = $(field).attr('name');
        let errorMsg = '';

        switch (fieldName) {
            case 'nome_funcionario':
                if (value.length === 0) {
                    errorMsg = 'Nome do funcionário é obrigatório.';
                } else if (value.length < 15) {
                    errorMsg = 'Nome do funcionário deve ter no mínimo 15 caracteres';
                }
                break;

            case 'rg':
                const rgPattern = /^\d{2}\.\d{3}\.\d{3}-\d{1}$/;
                if (value.length === 0) {
                    errorMsg = 'RG é obrigatório.';
                } else if (!rgPattern.test(value)) {
                    errorMsg = 'RG inválido. Formato esperado: 00.000.000-0';
                }
                break;

            case 'cpf':
                if (value.length === 0) {
                    errorMsg = 'CPF é obrigatório.';
                } else if (!validateCPF(value)) {
                    errorMsg = 'CPF inválido.';
                }
                break;

            case 'data_nasc':
                const dataPattern = /^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/]\d{4}$/;
                if (value.length === 0) {
                    errorMsg = 'Data de Nascimento é obrigatória.';
                } else if (!dataPattern.test(value)) {
                    errorMsg = 'Data de Nascimento inválida. Formato esperado: DD/MM/AAAA';
                }
                break;

            case 'turno':
                if (value.length === 0) {
                    errorMsg = 'Turno Disponível é obrigatório.';
                }
                break;

            case 'grau_escolaridade':
                if (value.length === 0) {
                    errorMsg = 'Grau de Escolaridade é obrigatório.';
                }
                break;

            case 'sexo':
                if (value.length === 0) {
                    errorMsg = 'Sexo é obrigatório.';
                }
                break;

            case 'cep':
                const cepPattern = /^\d{5}-\d{3}$/;
                if (value.length === 0) {
                    errorMsg = 'CEP é obrigatório.';
                } else if (!cepPattern.test(value)) {
                    errorMsg = 'CEP inválido. Formato esperado: 00000-000';
                }
                break;

            case 'numero':
                if (value.length === 0) {
                    errorMsg = 'Número é obrigatório.';
                }
                break;

            default:
                break;
        }

        $(field).next('.spans').text(errorMsg);
        return errorMsg.length === 0;
    }

    // Manipulação do formulário de cadastro
    $('#form').on('submit', function (e) {
        e.preventDefault();
        let isValid = true;

        $('input, select').each(function () {
            if (!validateField(this)) {
                isValid = false;
            }
        });

        // Verifica se as mensagens de erro estão vazias
        $('.spans').each(function () {
            if ($(this).text() !== '') {
                isValid = false;
            }
        });

        if (isValid) {

            let listaFuncionarios = JSON.parse(localStorage.getItem('listaFuncionarios') || '[]');

            // Obtendo os valores dos campos com jQuery
            let nomeFuncionario = $('#nome_funcionario').val();
            let rg = $('#rg').val();
            let cpf = $('#cpf').val();
            let dataNasc = $('#data_nasc').val();
            let turno = $('#turno').val();
            let grauEscolaridade = $('#grau_escolaridade').val();
            let sexo = $('#sexo').val();
            let cep = $('#cep').val();
            let rua = $('#rua').val();
            let bairro = $('#bairro').val();
            let cidade = $('#cidade').val();
            let numero = $('#numero').val();
            let complemento = $('#complemento').val();

            // Verifica se o CPF já está cadastrado
            let cpfExists = listaFuncionarios.some(func => func.cpf === cpf);
            if (cpfExists) {
                $('#successMessage').text('CPF já cadastrado!').css('color', 'red').show();
                return;
            }

            listaFuncionarios.push({
                nomeFuncionario: nomeFuncionario,
                rg: rg,
                cpf: cpf,
                dataNasc: dataNasc,
                turno: turno,
                grauEscolaridade: grauEscolaridade,
                sexo: sexo,
                cep: cep,
                rua: rua,
                bairro: bairro,
                cidade: cidade,
                numero: numero,
                complemento: complemento
            });

            localStorage.setItem('listaFuncionarios', JSON.stringify(listaFuncionarios));

            $('#successMessage').text('Cadastro realizado com sucesso!').css('color', 'green').show(); // Exibe a mensagem de sucesso
            $('#form')[0].reset(); // Limpa todos os inputs
            setTimeout(function () {
                $('#successMessage').hide();
            }, 3000); // 3000 milissegundos = 3 segundos
        } else {
            $('#successMessage').hide(); // Oculta a mensagem de sucesso se houver erro
        }
    });

    // Limpar campos do formulário de cadastro
    $('#clearBtn').on('click', function () {
        $('#form')[0].reset(); // Limpa todos os inputs
        $('.spans').text(''); // Limpa todas as mensagens de erro
        $('#successMessage').text('').hide(); // Esconde a mensagem de sucesso
    });

});
