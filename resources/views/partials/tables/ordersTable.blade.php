<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Clientes_ID</th>
      <th>Total</th>
      <th>Fecha</th>
      <th>Factura</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->client_id }}</td>
        <td>{{ $order->total }}</td>
        <td>{{ $order->date }}</td>
        <td class="flex items-center justify-center gap-2">
          <a href="{{ asset($order->route) }}" target="blank" class="px-2 py-2 bg-gray-300 rounded-full">
            <i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
              </svg></i>
          </a>
          <a href="{{ asset($order->route) }}" download class="px-2 py-2 bg-gray-300 rounded-full">
            <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
              </svg>
            </i>
          </a>
        </td>
        <td>
          @include('partials.buttons.editButton', ['mode' => $mode, 'id' => $order->id])
          @include('partials.buttons.deleteButton', ['mode' => $mode, 'object' => $order])
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
