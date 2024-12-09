@extends('layouts.app')

@section('title', 'Agregar pedidos')

@section('content')
  <div class="content-wrapper">
    @include('layouts.partials.msg')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-secondary text-white">
                <h3>@yield('title')</h3>
              </div>
              <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body" id="form-fields">
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <label>Cliente <strong style="color:red;">(*)</strong></label>

                        <select name="client_id" class="form-control select2" value="{{ old('client_id') }}">
                          <option value="-1">Seleccione el cliente</option>
                          @foreach ($clients as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }} ({{ $cliente->document }})</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <input type="hidden" class="form-control" name="status" value="1">
                      <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">
                    </div>
                  </div>

                  <div class="row align-items-center mt-3 border p-3">
                    <div class="col-12 col-md-3">
                      <label for="producto">Producto</label>
                      <select id="producto" class="form-control">
                        <option value="-">Seleccione un producto</option>
                        @foreach ($products as $producto)
                          <option value="{{ $producto->id }}" data-price="{{ $producto->price }}"
                            data-name="{{ $producto->name }}">
                            {{ $producto->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-12 col-md-2">
                      <label for="quantity">Cantidad</label>
                      <input type="number" name="quantity" class="form-control">
                    </div>
                    <div class="col-12 col-md-2">
                      <label for="price">Precio</label>
                      <input type="number" name="price" class="form-control" readonly>
                    </div>
                    <div class="col-12 col-md-2">
                      <label for="subtotal">Subtotal</label>
                      <input type="number" name="subtotal" class="form-control" readonly>
                    </div>
                    <div class="col-12 col-md-2">
                      <!-- Botón Añadir ajustado al mismo tamaño -->
                      <button type="button" class="btn btn-primary w-100" id="add-btn">Añadir</button>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-12">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody id="list-products">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="card-footer bg-light">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <!-- Total a la izquierda -->
                    <div class="col-12 col-md-2 text-start mb-2 mb-md-0">
                      <span class="h4 d-block" id="total-text">Total: $0</span>
                      <input name="total" hidden>
                    </div>

                    <!-- Contenedor para los botones centrados -->
                    <div class="d-flex justify-content-center w-100">
                      <!-- Botón de registrar -->
                      <div class="col-12 col-md-3 text-center mb-2 mb-md-0">
                        <button type="submit" class="btn btn-success btn-lg mx-2 shadow-sm">
                          <i class="fas fa-check-circle"></i> Registrar
                        </button>
                      </div>

                      <!-- Botón de volver -->
                      <div class="col-12 col-md-3 text-center">
                        <a href="{{ route('orders.index') }}" class="btn btn-danger btn-lg mx-2 shadow-sm">
                          <i class="fas fa-arrow-left"></i> Volver
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    /* Asegura que los elementos en las filas sean visibles y estén alineados correctamente */
    .select2-container .select2-selection--single {
      height: auto;
    }

    .table th,
    .table td {
      text-align: center;
      vertical-align: middle;
    }

    /* Ajustes de la tabla */
    #list-products tr td {
      vertical-align: middle;
    }

    /* Para que los botones se ajusten */
    .btn {
      width: 100%;
    }

    /* Ajustes para el diseño responsivo */
    @media (max-width: 767px) {
      .row.align-items-center {
        flex-direction: column;
      }

      .col-12.col-md-3,
      .col-12.col-md-2 {
        margin-bottom: 15px;
      }

      .col-12.col-md-4 {
        margin-bottom: 15px;
      }
    }
  </style>
@endsection




@push('scripts')
  <script>
    class Order {
      constructor(id, name, quantity, price, date) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.quantity = quantity;
        this.date = date;
      }

      get subtotal() {
        return this.price * this.quantity;
      }

      generateHTML(index) {
        return `
            <tr id="order-row-${index}">
                <td>${this.name}</td>
                <td>${this.date}</td>
                <td>${this.quantity}</td>
                <td>$${this.price.toFixed(2)}</td>
                <td>$${this.subtotal.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger delete-btn" data-index="${index}">Delete</button></td>
                <input hidden name="product_id[]" value="${this.id}">
                <input hidden name="quantity[]" value="${this.quantity}">
                <input hidden name="date[]" value="${this.date}">
            </tr>
            `;
      }
    }

    let nodeInputPrice = document.querySelector('[name="price"]');
    let nodeInputQuantity = document.querySelector('[name="quantity"]');
    let nodeInputSubtotal = document.querySelector('[name="subtotal"]');
    let nodeInputTotal = document.querySelector('[name="total"]');
    let nodeListProducts = document.querySelector('#list-products');
    let nodeInputDate = document.querySelector('[name="fecha"]');

    const orders = [];

    function clearInputFields() {
      nodeInputPrice.value = '';
      nodeInputQuantity.value = '';
      nodeInputSubtotal.value = '';
    }

    function pushOrder(order) {
      const index = orders.length;
      orders.push(order);

      updateTotal();
      nodeListProducts.innerHTML += order.generateHTML(index);
    }

    function updateTotal() {
      let total = orders.reduce((sum, order) => sum + order.subtotal, 0);
      document.querySelector('#total-text').innerText = `Total: $${total.toFixed(2)}`;
      nodeInputTotal.value = total.toFixed(2);
    }

    let currentOrder = new Order("", "", 0, 0, "");

    function updateCurrentOrder() {
      nodeInputPrice.value = currentOrder.price.toFixed(2);
      nodeInputQuantity.value = currentOrder.quantity;
      nodeInputSubtotal.value = currentOrder.subtotal.toFixed(2);
    }

    function renderTableRows() {
      nodeListProducts.innerHTML = "";
      orders.forEach((order, index) => {
        nodeListProducts.innerHTML += order.generateHTML(index);
      });
      updateTotal();
    }

    $(document).ready(function() {
      $('.select2').select2();

      let productSelect = $('#producto');
      productSelect.select2();

      $('#add-btn').on("click", (e) => {
        e.preventDefault();

        let date = nodeInputDate.value;

        if (currentOrder.id && currentOrder.quantity > 0 && date) {
          currentOrder.date = date; // Asignamos la fecha al pedido actual
          pushOrder(currentOrder);
          clearInputFields();
          productSelect.val('-').trigger('change');
        } else {
          alert("Por favor, seleccione un producto, ingrese una cantidad válida y seleccione una fecha.");
        }
      });

      productSelect.on('select2:select', function() {
        let selectedOption = productSelect.find(':selected');
        currentOrder.id = parseInt(selectedOption.val());
        currentOrder.name = selectedOption.data('name');
        currentOrder.price = parseFloat(selectedOption.data('price'));
        currentOrder.quantity = 1; // Default to 1

        updateCurrentOrder();
      });

      $(document).on('click', '.delete-btn', function() {
        let index = $(this).data('index');
        orders.splice(index, 1);
        renderTableRows();
      });
    });

    nodeInputQuantity.addEventListener('input', () => {
      currentOrder.quantity = parseInt(nodeInputQuantity.value) || 0;
      updateCurrentOrder();
    });
  </script>
@endpush
