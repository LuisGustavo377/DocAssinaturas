$(document).ready(function () {
    // Validação de formulário
    $('#licencaInput').on('change', function () {
        var licencaInput = $(this).val();
        if (licencaInput.trim() !== '') {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });

    // Função para carregar as licenças com base no grupo selecionado
    function carregarLicencas(grupo_de_negocio_id, licenca_selecionada_id = null) {
        $.ajax({
            url: "/admin/licencas-por-grupo",
            data: {
                grupo_de_negocio_id: grupo_de_negocio_id
            },
            success: function (data) {
                $('#licencaInput').empty();
                if (!grupo_de_negocio_id) {
                    $('#licencaInput').prop('disabled', true); // Desabilita o campo se nenhum grupo estiver selecionado
                    return;
                }

                $('#licencaInput').prop('disabled', false); // Habilita o campo

                // Adiciona a opção '-- Selecione uma Licença --' apenas se o grupo selecionado for diferente do grupo do banco de dados
                if (grupo_de_negocio_id != selectedGrupo) {
                    $('#licencaInput').append('<option value="" disabled selected>-- Selecione uma Licença --</option>');
                }

                if (data.length === 0) {
                    $('#licencaInput').append('<option value="" disabled>Nenhuma Licença encontrada</option>'); // Adiciona a mensagem de aviso quando não houver licenças disponíveis
                } else {
                    $.each(data, function (index, licenca) {
                        var option = $('<option value="' + licenca.id + '">' + licenca.descricao + '</option>');
                        if (licenca.id == licenca_selecionada_id) {
                            option.attr('selected', 'selected');
                        }
                        $('#licencaInput').append(option);
                    });
                }

                // Atualiza o valor de selectedGrupo para o novo grupo selecionado
                selectedGrupo = grupo_de_negocio_id;
            },
            error: function () {
                // Lógica de tratamento de erro, se necessário
            }
        });
    }

    // Obtém o ID da licença selecionada anteriormente
    var selectedLicencaID = localStorage.getItem('selectedLicencaID');

    // Obtém o ID do grupo selecionado anteriormente
    var selectedGrupo = localStorage.getItem('selectedGrupo');

    // Carrega as licenças quando a página é carregada
    carregarLicencas(selectedGrupo, selectedLicencaID);

    // Atualiza o valor de selectedGrupo para o novo grupo selecionado
    $('#grupoInput').on('change', function () {
        var grupo_de_negocio_id = $(this).val();
        carregarLicencas(grupo_de_negocio_id, selectedLicencaID); // Passa o ID da licença selecionada anteriormente
        localStorage.setItem('selectedGrupo', grupo_de_negocio_id); // Salva o ID do grupo selecionado no localStorage
    }).trigger('change'); // Dispara manualmente o evento change ao carregar a página

    // Evento de mudança para salvar o ID da licença selecionada no localStorage
    $('#licencaInput').on('change', function () {
        var selectedLicencaID = $(this).val();
        localStorage.setItem('selectedLicencaID', selectedLicencaID);
    });
});