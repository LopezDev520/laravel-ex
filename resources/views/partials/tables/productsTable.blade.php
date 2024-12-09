<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Precio</th>
      <th>Imagen</th>
      <th>Cantidad</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td>
          <img src="{{ asset('uploads/productos/' . $product->image) }}" alt="No disponible" width="150" height="150" />
        </td>
        <td>{{ $product->stock }}</td>
        <td>
          @include("partials.buttons.statusChange", ["mode" => $mode, "id" => $product->id, "status" => $product->status])
        </td>
        <td class="flex items-center justify-center gap-1.5">
          @include("partials.buttons.editButton", ["mode" => $mode, "id" => $product->id])
          @include("partials.buttons.deleteButton", ["mode" => $mode, "object" => $product])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
