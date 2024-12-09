@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Registrar Nuevo Cliente</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('clients.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone">
          </div>
          <button type="submit" class="btn btn-success">Guardar</button>
          <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
