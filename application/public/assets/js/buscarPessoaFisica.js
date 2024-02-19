    $(document).ready(function() {
        $('#cpfInput').on('input', function() {
            var cpf = $(this).val().replace(/[^\d]+/g,''); 
            if (cpf.length === 11) { // Assuming CPF has 11 digits
                $.ajax({
                    url: '/api/pessoafisica/' + cpf,
                    type: 'GET',
                    success: function(response) {
                        if (response && response.id) { // Verifica se a resposta não está vazia e se possui o id
                            $('#cpfIdInput').val(response.id); // Salva o ID cpf em um campo oculto
                            $('#pessoaFisicaResult').html('Pessoa encontrada: ' + response.nome);
                        } else {
                            $('#cpfIdInput').val(''); // Limpa o campo do ID cpf
                            $('#pessoaFisicaResult').html('Pessoa não encontrada.');
                        }
                    },
                    error: function() {
                        $('#cpfIdInput').val(''); // Limpa o campo do ID cpf
                        $('#pessoaFisicaResult').html('Erro ao buscar pessoa.');
                    }
                });
            } else {
                $('#cpfIdInput').val(''); // Limpa o campo do ID cpf
                $('#pessoaFisicaResult').html('');
            }
        });
    });

