<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Header de pagina -->
          <div class="my-3 p-4 rounded bg-slate-300 flex justify-between items-center">
            <h1 class="font-bold text-lg">Listado de Productos</h1>
            <a href="{{ route('products.create') }}"
              class="p-2.5 border-1 border-blue-400 rounded hover:bg-blue-400 text-blue-950 cursor-pointer flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
              </svg>
            </a>
          </div>

          <div class="card">
            <div class="card-body">
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
                        <img src="{{ asset('uploads/productos/' . $product->image) }}" width="150" height="150" />
                      </td>
                      <td>{{ $product->stock }}</td>
                      <td>
                        <input data-type="product" data-id={{ $product->id }} class="toggle-class" type="checkbox"
                          data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo"
                          data-off="Inactivo" {{ $product->status == 0 ? '' : 'checked' }} />
                      </td>
                      <td class="flex items-center gap-1.5">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">
                          <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                              <path fill="currentColor"
                                d="m410.3 231l11.3-11.3l-33.9-33.9l-62.1-62.1l-33.9-33.9l-11.3 11.3l-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2l199.2-199.2zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9l-78.2 23l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7l-14.4 14.5l-22.6 22.6l-11.4 11.3l33.9 33.9l62.1 62.1l33.9 33.9l11.3-11.3l22.6-22.6l14.5-14.5c25-25 25-65.5 0-90.5l-39.3-39.4c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6" />
                            </svg>
                          </i>
                        </a>

                        <form class="d-inline delete-form" action="{{ route('products.destroy', $product) }}"
                          method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger">
                            <i>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                  d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3zm0 5h2v9H9zm4 0h2v9h-2z" />
                              </svg>
                            </i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <script>
    $('.delete-form').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: 'Estas seguro?',
        text: "Este registro se eliminara definitivamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      })
    });
  </script>

  @if (session('eliminar') == 'ok')
    <script>
      Swal.fire(
        'Eliminado',
        'El registro ha sido eliminado exitosamente',
        'success'
      )
    </script>
  @endif

  <!-- /.content -->
</div>
