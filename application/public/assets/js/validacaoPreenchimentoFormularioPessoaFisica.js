// Carregar o jQuery
var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
script.type = 'text/javascript';
script.onload = function() {
    // Agora que o jQuery está carregado, podemos iniciar o seu código
    $(document).ready(function() {    

        $('#nomeInput').on('input', function() {
            var nome = $(this).val();
            if (nome.trim() !== '') {
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
    
        $('#telefoneInput').on('input', function() {
            var telefone = $(this).val();
            if (telefone.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#emailInput').on('input', function() {
            var email = $(this).val();
            if (email.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#tipoLogradouroInput').on('input', function() {
            var tipo_de_logradouro = $(this).val();
            if (tipo_de_logradouro.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#logradouroInput').on('input', function() {
            var logradouro = $(this).val();
            if (logradouro.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#numeroInput').on('input', function() {
            var numero = $(this).val();
            if (numero.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
    
        $('#complementoInput').on('input', function() {
            var complemento = $(this).val();
            if (complemento.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        
        $('#bairroInput').on('input', function() {
            var bairro = $(this).val();
            if (bairro.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#estadoSelect').on('input', function() {
            var estado = $(this).val();
            if (estado.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#cidadeSelect').on('input', function() {
            var cidade = $(this).val();
            if (cidade.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
        
        
    });
};
document.head.appendChild(script);
