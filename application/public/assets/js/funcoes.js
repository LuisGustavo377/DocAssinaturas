function mascaraTelefone(input) {
    let valor = input.value.replace(/\D/g, '');
    let padrao;

    if (valor.length <= 10) {
        // Formato para telefone fixo (10 dígitos)
        padrao = /^(\d{2})(\d{4})(\d{4})$/;
    } else {
        // Formato para celular (11 dígitos)
        padrao = /^(\d{2})(\d{5})(\d{4})$/;
    }

    if (padrao.test(valor)) {
        if (valor.length <= 10) {
            // Telefone fixo
            input.value = '(' + RegExp.$1 + ') ' + RegExp.$2 + '-' + RegExp.$3;
        } else {
            // Celular
            input.value = '(' + RegExp.$1 + ') ' + RegExp.$2 + '-' + RegExp.$3;
        }
    } else {
        input.value = valor;
    }
}


