<select class="form-control select2" title="Documento de trámite" id="tipo_tramite_id" name="tipo_tramite_id">
    <option value="">-Seleccionar-</option>
    @forelse ($tipoTramites as $tipo)
    <option value="{{ $tipo->id }}">{{$tipo->nombre}}</option>
    @empty
    <option value="00">-Configurar-</option>
    @endforelse
</select>
