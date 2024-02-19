    $(document).ready(function() {
        $('#pessoaJuridicaInput').on('input', function() {
            var cnpj = $(this).val();
            if (cnpj.length === 14) { // Assuming CPF has 11 digits
                $.ajax({
                    url: '/api/pessoajuridica/' + cnpj,
                    type: 'GET',
                    success: function(response) {
                        if (response && response.razao_social) { // Verifica se a resposta não está vazia e se possui o nome
                            $('#pessoaJuridicaResult').html('Pessoa encontrada: ' + response.razao_social);
                        } else {
                            $('#pessoaJuridicaResult').html('Pessoa não encontrada.');
                        }
                    },
                    error: function() {
                        $('#pessoaJuridicaResult').html('Erro ao buscar pessoa.');
                    }
                });
            } else {
                $('#pessoaJuridicaResult').html('');
            }
        });
    });

