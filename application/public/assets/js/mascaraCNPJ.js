// Carregar o jQuery
var scriptJQuery = document.createElement('script');
scriptJQuery.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.head.appendChild(scriptJQuery);

// Carregar o jQuery Mask Plugin
var scriptJQueryMask = document.createElement('script');
scriptJQueryMask.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js';
document.head.appendChild(scriptJQueryMask);

// Esperar até que ambos os scripts estejam carregados
scriptJQuery.onload = scriptJQueryMask.onload = function() {
    // Executar o código que depende dos scripts carregados
    $(document).ready(function() {
        $('#cnpjInput').mask('00.000.000/0000-00', {
            reverse: true
        });
    });
};
