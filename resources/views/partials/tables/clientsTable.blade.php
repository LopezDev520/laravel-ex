<table id="clientsTable" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Documento</th>
      <th>Imagen</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clients as $client)
      <tr>
        <td>{{ $client->id }}</td>
        <td>{{ $client->name }}</td>
        <td>{{ $client->email }}</td>
        <td>{{ $client->phone }}</td>
        <td>{{ $client->address }}</td>
        <td>{{ $client->document }}</td>
        <td>
          <img src="{{ asset('uploads/clientes/' . $client->photo) }}" alt="Imagen de {{ $client->name }}" style="width: 50px; height: 50px;">
        </td>
        <td>
          @include("partials.buttons.statusChange", ["status" => $client->status, "id" => $client->id, "mode" => $mode])
        </td>
        <td>
          @include("partials.buttons.editButton", ["mode" => $mode, "id" => $client->id])
          @include("partials.buttons.deleteButton", ["mode" => $mode, "object" => $client])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
