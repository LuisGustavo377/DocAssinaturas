$(document).ready(function() {
    $('#cpf-cnpj').on('input', function() {
        var value = $(this).val();
        // Remove a máscara para contar apenas os dígitos
        var digitos = value.replace(/[^\d]/g, '');

        // Determina se é CPF ou CNPJ com base na quantidade de dígitos
        if (digitos.length <= 11) {
            // Aplica a máscara de CPF
            $(this).mask('000.000.000-00', {
                reverse: true
            });
        } else {
            // Aplica a máscara de CNPJ
            $(this).mask('00.000.000/0000-00', {
                reverse: true
            });
        }
    });

    // Define a máscara inicialmente com base no tipo de pessoa
    var tipoPessoa = '{{ $unidade->tipo_pessoa }}';
    if (tipoPessoa === 'pf') {
        $('#cpf-cnpj').mask('000.000.000-00', {
            reverse: true
        });
    } else {
        $('#cpf-cnpj').mask('00.000.000/0000-00', {
            reverse: true
        });
    }
});