// <!-- Inicio alteração do campo de seleção do grupo de negócios, e atualizar dinamicamente as opções do campo de seleção de licença -->
var scriptJQuery = document.createElement('script');
scriptJQuery.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.head.appendChild(scriptJQuery);


$(document).ready(function () {
    $('#grupoInput').change(function () {
        var grupos_de_negocio_id = $(this).val();
        $.ajax({
            url: "{{ route('admin.licencas.licencasPorGrupo') }}",
            data: {
                grupos_de_negocio_id: grupos_de_negocio_id
            },
            success: function (data) {
                $('#licencaInput').empty();
                $('#licencaInput').append(
                    '<option value="" disabled selected>Selecione uma Licença</option>'
                );
                $.each(data, function (index, licenca) {
                    $('#licencaInput').append('<option value="' + licenca.id +
                        '">' + licenca.descricao + '</option>');
                });
            }
        });
    });
});
