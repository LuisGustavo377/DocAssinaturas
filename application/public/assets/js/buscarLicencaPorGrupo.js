$(document).ready(function () {

    // Função para carregar as licenças com base no grupo selecionado
    function carregarLicencas(grupo_de_negocio_id, licenca_selecionada_id) {
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
                        '<option value="" disabled>--Selecione uma Licença--</option>'
                    );
                    $.each(data, function (index, licenca) {
                        $('#licencaInput').append('<option value="' + licenca.id +
                            '">' + licenca.descricao + '</option>');
                    });
                }

                // Verifica se há uma licença selecionada e a marca como selecionada
                if (licenca_selecionada_id) {
                    $('#licencaInput').val(licenca_selecionada_id);
                }
            },
            error: function () {
                // Adicione aqui a lógica de tratamento de erro, se necessário
            }
        });
    }

    // Obtém a licença selecionada do localStorage
    var selectedLicencaID = localStorage.getItem('selectedLicencaID');

    // Carregar as licenças quando a página é carregada
    var selectedGrupo = $('#grupoInput').val();
    carregarLicencas(selectedGrupo, selectedLicencaID);

    // Carregar as licenças novamente sempre que o grupo é alterado
    $('#grupoInput').on('change', function () {
        var grupo_de_negocio_id = $(this).val();
        carregarLicencas(grupo_de_negocio_id);
    });

    // Evento de mudança para salvar a licença selecionada no localStorage
    $('#licencaInput').on('change', function () {
        var selectedLicencaID = $(this).val();
        localStorage.setItem('selectedLicencaID', selectedLicencaID);
    });
});
