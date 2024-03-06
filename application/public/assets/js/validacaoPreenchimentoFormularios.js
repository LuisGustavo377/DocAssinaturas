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

        $('#numero_contratoInput').on('input', function() {
            var numero = $(this).val();
            if (numero.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#planoInput').on('input', function() {
            var plano = $(this).val();
            if (plano.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#tipoDeRenovacaoInput').on('input', function() {
            var tipoRenovacao = $(this).val();
            if (tipoRenovacao.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        
        $('#inicioInput').on('input', function() {
            var inicio = $(this).val();
            if (inicio.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#terminoInput').on('input', function() {
            var termino = $(this).val();
            if (termino.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#senhaTemporaria').on('input', function() {
            var senha = $(this).val();
            if (senha.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });


        
    });
};
document.head.appendChild(script);
