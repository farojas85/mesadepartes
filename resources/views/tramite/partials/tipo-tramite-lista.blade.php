<select class="form-control select2" title="Documento de trámite" id="tipo_tramite_id" name="tipo_tramite_id">
    <option value="">-Seleccionar-</option>
    <option value="1">-Seleccionar-</option>
    <option value="3">-Seleccionar-</option>
    <option value="4">-Seleccionar-</option>
    <option value="5">-Seleccionar-</option>
    <option value="6">-Seleccionar-</option>
    <option value="7">-Seleccionar-</option>
    <option value="8">-Seleccionar-</option>
    @forelse ($tipoTramites as $tipo)
    <option value="{{ $tipo->id }}">{{$tipo->nombre}}</option>
    @empty
    <option value="00">-Configurar-</option>
    @endforelse
</select>
