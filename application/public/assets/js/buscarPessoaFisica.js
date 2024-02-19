    $(document).ready(function() {
        $('#pessoaFisicaInput').on('input', function() {
            var cpf = $(this).val();
            if (cpf.length === 11) { // Assuming CPF has 11 digits
                $.ajax({
                    url: '/api/pessoafisica/' + cpf,
                    type: 'GET',
                    success: function(response) {
                        if (response && response.nome) { // Verifica se a resposta não está vazia e se possui o nome
                            $('#pessoaFisicaResult').html('Pessoa encontrada: ' + response.nome);
                        } else {
                            $('#pessoaFisicaResult').html('Pessoa não encontrada.');
                        }
                    },
                    error: function() {
                        $('#pessoaFisicaResult').html('Erro ao buscar pessoa.');
                    }
                });
            } else {
                $('#pessoaFisicaResult').html('');
            }
        });
    });

