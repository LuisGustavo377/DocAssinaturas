$(document).ready(function() {
    // Desabilitar o campo de cidade inicialmente
    $('#cidadeSelect').prop('disabled', true);

    $('#estadoSelect').change(function() {
        var estado_id = $(this).val();

        // Limpar o dropdown de cidades
        $('#cidadeSelect').empty();

        if (estado_id) {
            // Remover o atributo disabled quando um estado for selecionado
            $('#cidadeSelect').prop('disabled', false);

            // Fazer a solicitação AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: '/api/cidades/' + estado_id,
                type: 'GET',
                success: function(data) {
                    // Adicionar as opções de cidades ao dropdown
                    $.each(data, function(key, value) {
                        $('#cidadeSelect').append(
                            $('<option></option>').val(value.id).text(value.nome)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            // Se nenhum estado for selecionado, desabilitar novamente o campo de cidade
            $('#cidadeSelect').prop('disabled', true);
        }
    });
});
