$(document).ready(function () {


    $('#cep').mask('00000-000');
    $('#telefone').mask('(00) 0000-0000');
    $('#celular').mask('(00) 00000-0000');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#numero').mask('00000');


    $('input').on('keyup', function () {
        validateField(this);
    });

    $('#nome_empresa').on('keypress', function (e) {

        const regex = /^[A-Za-zÀ-ÿ\s]$/;


        const char = String.fromCharCode(e.which);


        if (!regex.test(char)) {
            e.preventDefault(); // Impede a digitação do caractere
        }
    });


    function validateField(field) {
        const value = $(field).val().trim();
        const fieldName = $(field).attr('name');
        let errorMsg = '';

        switch (fieldName) {
            case 'nome_empresa':
                const namePattern = /^[A-Za-zÀ-ÿ\s]+$/;
                errorMsg = value.length === 0 ? 'Nome da empresa é obrigatório.' :
                            !namePattern.test(value) ? 'O nome só pode conter letras e espaços.' : '';
                break;            
            case 'email':
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                errorMsg = value.length === 0 ? 'Email é obrigatório.' : !emailPattern.test(value) ? 'Email inválido.' : '';
                break;
            case 'senha':
                errorMsg =  value.length === 0 ? 'A senha é obrigatória.' :
                            value.length != 8 ? 'A senha deve ter 8 caracteres.' : '';
                break;
            case 'password-confirm':
                errorMsg = value !== $('#password').val() ? 'As senhas não coincidem.' : '';
                break;
            case 'cnpj':
                errorMsg = value.length === 0 ? 'CNPJ é obrigatório.' : !validateCNPJ(value) ? 'CNPJ inválido.' : '';
                break;
            case 'cep':
                const cepPattern = /^\d{5}-\d{3}$/;
                errorMsg = value.length === 0 ? 'CEP é obrigatório.' : !cepPattern.test(value) ? 'CEP inválido. Formato esperado: 00000-000' : '';
                break;
            case 'numero':
                errorMsg = value.length === 0 ? 'Número é obrigatório.' : '';
                break;
            case 'telefone':
            case 'celular':
                const telefonePattern = fieldName === 'telefone' ? /^\(\d{2}\) \d{4}-\d{4}$/ : /^\(\d{2}\) \d{5}-\d{4}$/;
                errorMsg = value.length === 0 ? `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} é obrigatório.` :
                            !telefonePattern.test(value) ? `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} inválido.` : '';
                break;
            default:
                break;
        }

        $(field).next('.spans').text(errorMsg);
        return errorMsg.length === 0;
    }


    $('#form').on('submit', function (e) {
        let isValid = true;

        $('input').each(function () {
            if (!validateField(this)) {
                isValid = false;
            }
        });


        $('.spans').each(function () {
            if ($(this).text() !== '') {
                isValid = false;
                e.preventDefault();
            }
        });

        if (!isValid) {
            e.preventDefault();
            $('#successMessage').hide(); 
        }
    });

    // Limpar campos do formulário
    $('#clearBtn').on('click', function () {
        $('#form')[0].reset();
        $('.spans').text(''); 
        $('#successMessage').text('').hide();
    });
});
