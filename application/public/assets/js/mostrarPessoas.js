$(document).ready(function() {
    $('#tipoPessoaSelect').change(function() {
        var tipoPessoa = $(this).val();
        if (tipoPessoa === "PF") {
            $('#cpfInputDiv').show();
            $('#cnpjInputDiv').hide();
        } else if (tipoPessoa === "PJ") {
            $('#cpfInputDiv').hide();
            $('#cnpjInputDiv').show();
        }
    });
});