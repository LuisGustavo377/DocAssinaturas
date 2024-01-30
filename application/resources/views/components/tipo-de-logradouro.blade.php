<div class="mb-3">
    <label id="tipoLogradouroLabel" class="form-label">Tipos de Logradouro</label>
    <select class="form-select @error('tipo_logradouro') is-invalid @enderror" id="tipoLogradouroInput"
        name="tipo_logradouro">
        <option value="">-- Selecione um tipo de logradouro --</option>
        <option value="alameda">Alameda</option>
        <option value="area">Área</option>
        <option value="avenida">Avenida</option>
        <option value="campo">Campo</option>
        <option value="chacara">Chácara</option>
        <option value="colonia">Colônia</option>
        <option value="condominio">Condomínio</option>
        <option value="conjunto">Conjunto</option>
        <option value="distrito">Distrito</option>
        <option value="esplanada">Esplanada</option>
        <option value="estacao">Estação</option>
        <option value="estrada">Estrada</option>
        <option value="favela">Favela</option>
        <option value="fazenda">Fazenda</option>
        <option value="feira">Feira</option>
        <option value="jardim">Jardim</option>
        <option value="ladeira">Ladeira</option>
        <option value="lago">Lago</option>
        <option value="lagoa">Lagoa</option>
        <option value="largo">Largo</option>
        <option value="loteamento">Loteamento</option>
        <option value="morro">Morro</option>
        <option value="nucleo">Núcleo</option>
        <option value="parque">Parque</option>
        <option value="passarela">Passarela</option>
        <option value="patio">Pátio</option>
        <option value="praca">Praça</option>
        <option value="quadra">Quadra</option>
        <option value="residencial">Residencial</option>
        <option value="rodovia">Rodovia</option>
        <option value="rua">Rua</option>
        <option value="setor">Setor</option>
        <option value="sitio">Sítio</option>
        <option value="travessa">Travessa</option>
        <option value="trecho">Trecho</option>
        <option value="trevo">Trevo</option>
        <option value="vale">Vale</option>
        <option value="vereda">Vereda</option>
        <option value="via">Via</option>
        <option value="viduto">Viaduto</option>
        <option value="viela">Viela</option>
        <option value="vila">Vila</option>
    </select>
    @error('tipo_logradouro')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>