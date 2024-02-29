$(document).ready(function() {
    $('#tipoPessoaSelect').change(function() {
        var tipoPessoa = $(this).val();
        if (tipoPessoa === "pf") {
            $('#cpfInputDiv').show();
            $('#cnpjInputDiv').hide();
        } else if (tipoPessoa === "pj") {
            $('#cpfInputDiv').hide();
            $('#cnpjInputDiv').show();
        }
    });
});