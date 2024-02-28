// Carregar o jQuery
var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
script.type = 'text/javascript';
script.onload = function() {
    // Agora que o jQuery está carregado, podemos iniciar o seu código
    $(document).ready(function() {    

        $('#grupoInput').on('input', function() {
            var grupo = $(this).val();
            if (grupo.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#licencaSelect').on('input', function() {
            var licenca = $(this).val();
            if (licenca.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
    
        $('#tipoPessoaSelect').on('input', function() {
            var tipoPessoa = $(this).val();
            if (tipoPessoa.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#cpfInput').on('input', function() {
            var cpf = $(this).val();
            if (cpf.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
        $('#cnpjInput').on('input', function() {
            var cnpj = $(this).val();
            if (cnpj.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#senha_temporaria').on('input', function() {
            var senha_temporaria = $(this).val();
            if (senha_temporaria.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
        
    });
};
document.head.appendChild(script);
