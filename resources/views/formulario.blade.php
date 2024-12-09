@extends('layouts.app')

@section('content')
  @if ($form == 'clients')
    @include('partials.formularios.cliente', ['client' => $client])
  @elseif ($form == "products")
    @include("partials.formularios.productos", ["product" => $product])
  @endif
@endsection
