// O script usa o ready ou seja é executado imediatamente após o documento HTML ser totalmente carregado
$(document).ready(function () {
    var grupo_de_negocio_id = $(this).val();
    $.ajax({
        url: "/admin/licencas-por-grupo/",
        data: {
            grupo_de_negocio_id: grupo_de_negocio_id
        },
        success: function (data) {
            $('#licencaInput').empty();
            if (data.length === 0) {
                // Adicionar uma mensagem de aviso se não houver licenças encontradas
                $('#licencaInput').append('<option value="" disabled selected>Nenhuma licença encontrada</option>');
            } else {
                // Adicionar as opções de licença normalmente se houver licenças encontradas
                $('#licencaInput').append('<option value="" disabled selected>--Selecione uma Licença--</option>');
                $.each(data, function (index, licenca) {
                    $('#licencaInput').append('<option value="' + licenca.id + '">' + licenca.descricao + '</option>');
                });
            }
        }
    });
});