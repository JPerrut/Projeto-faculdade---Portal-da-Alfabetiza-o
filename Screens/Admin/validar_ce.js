
// Aplicação de máscaras aos inputs
$('#cep').mask('00000-000');
$('#telefone').mask('(00) 0000-0000');
$('#celular').mask('(00) 00000-0000');
$('#numero').mask('00000');

// Validação de campos do formulário
$('input').on('keyup', function () {
    validateField(this);
});

// Impedir digitação de caracteres não permitidos no campo nome
$('#nome_escola').on('keypress', function (e) {
// Expressão regular que permite apenas letras e espaços
const regex = /^[A-Za-zÀ-ÿ\s]$/;

// Verifica o código da tecla pressionada
const char = String.fromCharCode(e.which);

// Se o caractere pressionado não corresponder ao padrão, impede a digitação
if (!regex.test(char)) {
    e.preventDefault(); // Impede a digitação do caractere
}
});

function validateField(field) {
    const value = $(field).val().trim();
    const fieldName = $(field).attr('name');
    let errorMsg = '';

    switch (fieldName) {
        case 'nome_escola':
            const namePattern = /^[A-Za-zÀ-ÿ\s]+$/;
            errorMsg = value.length === 0 ? 'Nome da escola é obrigatório.' :
                        !namePattern.test(value) ? 'O nome só pode conter letras e espaços.' : '';
            break;            
        case 'email':
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            errorMsg = value.length === 0 ? 'O email é obrigatório.' : !emailPattern.test(value) ? 'Email inválido.' : '';
            break;
        case 'cep':
            errorMsg =  value.length === 0 ? 'O CEP é obrigatório.' :
                        value.length != 9 ? 'CEP inválido.' : '';
            break;
        case 'estado':
            errorMsg =  value.length === 0 ? 'O estado é obrigatório.' : ''
            break;
        case 'cidade':
            errorMsg =  value.length === 0 ? 'A cidade é obrigatória.' : ''

            break;
        case 'bairro':
            errorMsg =  value.length === 0 ? 'O bairro é obrigatório.' : ''

            break;
        case 'rua':
            errorMsg =  value.length === 0 ? 'A rua é obrigatória.' : ''

            break;
        case 'numero':
            errorMsg = value.length === 0 ? 'Número da casa é obrigatório.' : '';
            break;
          
        case 'telefone':
        case 'celular':
          const telefonePattern = fieldName === 'telefone' ? /^\(\d{2}\) \d{4}-\d{4}$/ : /^\(\d{2}\) \d{5}-\d{4}$/;
          errorMsg = value.length === 0 ? `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} é obrigatório.` :
          !telefonePattern.test(value) ? `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} inválido.` : '';
          break;
          default:
          break;
        case 'hora_aula':
          errorMsg = value.length === 0 ? 'As horas das aulas são obrigatórias.' : '';
          break;
              }

    $(field).next('.spans').text(errorMsg);
    return errorMsg.length === 0;
}

// Manipulação do formulário
$('#form').on('submit', function (e) {
    let isValid = true;

    $('input').each(function () {
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

    if (!isValid) {
        e.preventDefault();
        $('#successMessage').hide(); // Oculta a mensagem de sucesso se houver erro
    }
});

// Limpar campos do formulário
$('#clearBtn').on('click', function () {
    $('#form')[0].reset(); // Limpa todos os inputs
    $('.spans').text(''); // Limpa todas as mensagens de erro
    $('#successMessage').text('').hide(); // Esconde a mensagem de sucesso
});


// ------------------------------------
// OBTENÇÃO DE DADOS DO CEP > BEGINNING
// ------------------------------------

$('#cep').on('blur', function () {
    const cep = $(this).val().replace(/\D/g, '');
    if (cep.length === 8) {
        $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            if (!data.erro) {
                $('#rua').val(data.logradouro).trigger('keyup');
                $('#bairro').val(data.bairro).trigger('keyup');
                $('#cidade').val(data.localidade).trigger('keyup');
                $('#estado').val(data.uf).trigger('keyup');
                $('#cep').next('.spans').text('');
            } else {
                $('#rua, #bairro, #cidade, #estado').val('');
                $('#cep').next('.spans').text('CEP não encontrado.');
            }
        }).fail(function () {
            $('#rua, #bairro, #cidade, #estado').val('');
            $('#cep').next('.spans').text('Erro ao buscar o CEP.');
        });
    } else if (cep.length === 0) {
        $('#cep').next('.spans').text('CEP é obrigatório.');
        $('#rua, #bairro, #cidade, #estado').val('');
    } else {
        $('#cep').next('.spans').text('CEP inválido.');
        $('#rua, #bairro, #cidade, #estado').val('');
    }
});

// ------------------------------------
// OBTENÇÃO DE DADOS DO CEP > END
// ------------------------------------