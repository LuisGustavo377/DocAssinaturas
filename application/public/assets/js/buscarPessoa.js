
$(document).ready(function() {
    $('#pessoaInput').on('input', function() {
        var cpf = $(this).val();
        if (cpf.length === 11) { // Assuming CPF has 11 digits
            $.ajax({
                url: '/api/pessoafisica/' + cpf,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#pessoaResult').html('Pessoa encontrada: ' + response.nome);
                    } else {
                        $('#pessoaResult').html('Pessoa não encontrada.');
                    }
                },
                error: function() {
                    $('#pessoaResult').html('Erro ao buscar pessoa.');
                }
            });
        } else {
            $('#pessoaResult').html('');
        }
    });
});



