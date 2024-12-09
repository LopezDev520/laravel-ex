
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ isset($client) ? 'Editar Cliente' : 'Nuevo Cliente' }}
    </h1>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if(isset($client))
            @method('PUT')
          @endif

          <!-- Campos del Cliente -->
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $client->name ?? '') }}" required>
          </div>

          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email ?? '') }}" required>
          </div>

          <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $client->phone ?? '') }}" required>
          </div>

          <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $client->address ?? '') }}">
          </div>

          <div class="form-group">
            <label for="document">Documento</label>
            <input class="form-control" id="document" name="document" value="{{ old('document', $client->document ?? '') }}">
          </div>

          <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" class="form-control" id="image" name="photo">
            @if(isset($client) && $client->photo)
              <img src="{{ asset('uploads/clientes/' . $client->photo) }}" alt="Imagen actual" style="width: 100px; height: 100px;">
            @endif
          </div>

          <!-- Campos ocultos -->
          <input type="hidden" name="registered_by" value="{{ Auth::user()->id }}">
          <input type="hidden" name="status" value="1">

          <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Actualizar Cliente' : 'Registrar Cliente' }}</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>