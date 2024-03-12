function mascaraCNPJ(input) {
    let valor = input.value.replace(/\D/g, '');
    let padrao = /^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/;

    if (padrao.test(valor)) {
        input.value = RegExp.$1 + '.' + RegExp.$2 + '.' + RegExp.$3 + '/' + RegExp.$4 + '-' + RegExp.$5;
    } else {
        input.value = valor;
    }
}