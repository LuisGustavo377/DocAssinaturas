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


        $('#razaoSocialInput').on('input', function() {
            var razao_social = $(this).val();
            if (razao_social.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#nomeFantasiaInput').on('input', function() {
            var nome_fantasia = $(this).val();
            if (nome_fantasia.trim() !== '') {
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
    
        $('#inscricaoEstadualInput').on('input', function() {
            var inscricao_estadual = $(this).val();
            if (inscricao_estadual.trim() !== '') {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    
        $('#inscricaoMunicipalInput').on('input', function() {
            var inscricao_municipal = $(this).val();
            if (inscricao_municipal.trim() !== '') {
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
