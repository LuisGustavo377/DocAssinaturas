$(document).ready(function () {
    // Armazenar a seleção atual do usuário
    var selectedGrupo = $('#grupoInput').val();

    $('#grupoInput').change(function () {
        var grupo_de_negocio_id = $(this).val();
        $.ajax({
            url: "/admin/licencas-por-grupo/",
            data: {
                grupo_de_negocio_id: grupo_de_negocio_id
            },
            success: function (data) {
                $('#licencaInput').empty();
                if (data.length === 0) {
                    $('#licencaInput').append(
                        '<option value="" disabled selected>Nenhuma licença encontrada</option>'
                    );
                } else {
                    $('#licencaInput').append(
                        '<option value="" disabled selected>--Selecione uma Licença--</option>'
                    );
                    $.each(data, function (index, licenca) {
                        $('#licencaInput').append('<option value="' + licenca.id +
                            '">' + licenca.descricao + '</option>');
                    });
                }
            },
            error: function () {
                // Restaurar a seleção do usuário em caso de falha
                $('#grupoInput').val(selectedGrupo);
            }
        });
    });
});
