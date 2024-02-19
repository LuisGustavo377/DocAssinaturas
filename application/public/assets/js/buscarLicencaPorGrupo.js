$(document).ready(function () {
    $('#grupoInput').change(function () {
        var grupos_de_negocio_id = $(this).val();
        $.ajax({
            url: "/admin/licencas-por-grupo/",
            data: {
                grupos_de_negocio_id: grupos_de_negocio_id
            },
            success: function (data) {
                $('#licencaInput').empty();
                $('#licencaInput').append(
                    '<option value="" disabled selected>--Selecione uma Licença--</option>'
                );
                $.each(data, function (index, licenca) {
                    $('#licencaInput').append('<option value="' + licenca.id +
                        '">' + licenca.descricao + '</option>');
                });
            }
        });
    });
});
