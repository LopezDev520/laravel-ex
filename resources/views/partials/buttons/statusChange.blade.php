<input data-type="{{ $mode }}" data-id={{ $id }} class="toggle-class" type="checkbox" data-onstyle="success"
  data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo"
  {{ $status == 0 ? '' : 'checked' }} />
