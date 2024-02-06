<div class="mb-3">
    <label id="statusLabel" class="form-label">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" id="statusInput"
        name="status">
        <option value="">-- Selecione o Status --</option>
        <option value="ativo">Ativo</option>
        <option value="inativo">Inativo</option>
        <option value="bloqueado">Bloqueado</option>
    @error('status')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>