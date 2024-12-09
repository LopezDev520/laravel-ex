@extends('layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Header de pagina -->
            <div class="my-3 p-4 rounded bg-slate-300 flex justify-between items-center">
              <h1 class="font-bold text-lg">Listado de {{ $modeEs }}</h1>
              <a href="{{ route($mode . '.create') }}"
                class="p-2.5 border-1 border-blue-400 rounded hover:bg-blue-400 text-blue-950 cursor-pointer flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                </svg>
                <p>Crear</p>
              </a>
            </div>

            <div class="card">
              <div class="card-body">
                @if ($mode == 'products')
                  @include('partials.tables.productsTable', ['products' => $products])
                @elseif ($mode == 'clients')
                  @include('partials.tables.clientsTable', ['clients' => $clients])
                @elseif ($mode == 'orders')
                  @include('partials.tables.ordersTable', ['orders' => $orders])
                @endif
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
    <!-- /.content -->
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#example1').DataTable();
    });
  </script>

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
@endpush
