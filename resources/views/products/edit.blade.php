@extends('layouts.app')

@section('title', 'Crear productos')

@section('content')

    <div class="content-wrapper">
        @include('layouts.partials.msg')

        <div class="card card-info m-6">
            <div class="card-header">
                <h3 class="card-title">Editar producto</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="flex *:flex-grow m-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Ingrese el nombre del producto" autocomplete="off"
                                    value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-form-label">Cantidad</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="stock"
                                    placeholder="Ingrese la cantidad del producto" autocomplete="off"
                                    value="{{ $product->stock }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-form-label">Precio</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="price"
                                    placeholder="Ingrese la cantidad del producto" autocomplete="off"
                                    value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" placeholder="Ingrese la descripcion del producto" id=""
                                cols="120" rows="4">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Imagen</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>
                    </div>

                    <img src="{{ asset('uploads/productos/' . $product->image) }}" width="150" height="150"
                        class="rounded" />

                    <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Enviar</button>
                    <a href="{{ route('products.index') }}" type="submit" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->

            </form>
        </div>
    </div>
@endsection
