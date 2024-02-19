$(document).ready(function () {
    $('#tipoPessoaSelect').change(function () {
        var tipoPessoa = $(this).val();
        $('#tipoPessoaInput').val(tipoPessoa);

        // Se o tipo de pessoa for PJ, preenche o campo oculto com "PJ"
        if (tipoPessoa === 'PJ') {
            $('#tipoPessoaInput').val('pj');
        }
        // Se o tipo de pessoa for PF, preenche o campo oculto com "PF"
        else if (tipoPessoa === 'PF') {
            $('#tipoPessoaInput').val('pf');
        }
    });
});