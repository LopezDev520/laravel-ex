@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
  <div class="container mt-5">
    <div class="card">
      <div class="py-6 px-4  flex justify-between items-center">
        <h3 class="card-title">Listado de Clientes</h3>
        <a href="{{ route('clients.create') }}" class="btn btn-success btn-sm">Añadir Cliente</a>
      </div>
      <div class="card-body">
        <table id="clientsTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo Electrónico</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $client)
            <tr>
              <td>{{ $client->id }}</td>
              <td>{{ $client->name }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->phone }}</td>
              <td>
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#clientsTable').DataTable();
  });
</script>
@endpush
