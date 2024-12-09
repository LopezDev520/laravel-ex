@extends('layouts.app')

@section('title', isset($product) ? 'Editar Producto' : 'Crear Producto')

@section('content')
<div class="content-wrapper">

    @include('layouts.partials.msg')

    <div class="card card-info m-6">
        <div class="card-header">
            <h3 class="card-title">{{ isset($product) ? 'Editar Producto' : 'Crear Producto' }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($product))
                @method('PUT') <!-- Método PUT para la edición -->
            @endif
            <div class="card-body">

                <div class="flex *:flex-grow m-3">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name"
                                placeholder="Ingrese el nombre del producto" autocomplete="off"
                                value="{{ old('name', isset($product) ? $product->name : '') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="stock"
                                placeholder="Ingrese la cantidad del producto" autocomplete="off"
                                value="{{ old('stock', isset($product) ? $product->stock : '') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price"
                                placeholder="Ingrese el precio del producto" autocomplete="off"
                                value="{{ old('price', isset($product) ? $product->price : '') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" placeholder="Ingrese la descripcion del producto" id=""
                            cols="120" rows="4">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="image" id="image">
                        @if(isset($product) && $product->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="Imagen del producto" class="img-thumbnail" width="100">
                            </div>
                        @endif
                    </div>
                </div>

                <input type="hidden" class="form-control" name="status" value="1">
                <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{ isset($product) ? 'Actualizar' : 'Enviar' }}</button>
                <a href="{{ route('products.index') }}" class="btn btn-default float-right">Cancelar</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>
@endsection
