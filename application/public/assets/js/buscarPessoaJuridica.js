$(document).ready(function () {
    $('#cnpjInput').on('input', function () {
        var cnpj = $(this).val().replace(/[^\d]+/g, ''); // Remove caracteres especiais do CNPJ

        if (cnpj.length === 14) {
            $.ajax({
                url: '/api/pessoajuridica/' + cnpj,
                type: 'GET',
                success: function (response) {
                    if (response && response.id) { // Verifica se a resposta não está vazia e se possui o ID
                        $('#razaoSocialIdInput').val(response.id); // Salva o ID da razão social em um campo oculto
                        $('#pessoaJuridicaResult').html('Pessoa encontrada: ' + response.razao_social);
                    } else {
                        $('#razaoSocialIdInput').val(''); // Limpa o campo do ID da razão social
                        $('#pessoaJuridicaResult').html('Pessoa não encontrada.');
                    }
                },
                error: function () {
                    $('#razaoSocialIdInput').val(''); // Limpa o campo do ID da razão social
                    $('#pessoaJuridicaResult').html('Erro ao buscar pessoa.');
                }
            });
        } else {
            $('#razaoSocialIdInput').val(''); // Limpa o campo do ID da razão social
            $('#pessoaJuridicaResult').html('');
        }
    });
});
