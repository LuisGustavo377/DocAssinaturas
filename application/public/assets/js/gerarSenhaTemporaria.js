
$(document).ready(function() {
    $('#senha_temporaria').on('input', function() {
        var senha_temporaria = $(this).val();
        if (senha_temporaria.trim() !== '') {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });

    // Adicione a validação ao clicar no botão "Gerar Senha"
    $('button.btn-outline-success').on('click', function() {
        // Chame a função para gerar a senha temporária
        generateTemporaryPassword();
        // Valide o campo de senha temporária
        var senha_temporaria = $('#senha_temporaria').val();
        if (senha_temporaria.trim() !== '') {
            $('#senha_temporaria').removeClass('is-invalid');
            $('#senha_temporaria').next('.invalid-feedback').remove();
        }
    });
});

function generateTemporaryPassword() {
    const temporaryPasswordInput = document.getElementById('senha_temporaria');
    const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
    temporaryPasswordInput.value = temporaryPassword;
}