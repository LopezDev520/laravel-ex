<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $mode = "products";
        $modeEs = "Productos";
        // return view("products.index", compact("products"));
        return view("listar", compact("products", "mode", "modeEs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {

        $image = $request->file('image');
        $slug = Str::slug($request->nombre);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/productos/')) {
                mkdir('uploads/productos/', 0777, true);
            }

            $image->move('uploads/productos', $imagename);
        } else {
            $imagename = "";
        }

        $producto = Product::create(array_merge($request->except("image"), [
            "image" => $imagename
        ]));

        return redirect()->route("products.index")->with("successMsg", "El registro se guardó exitosamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $form = "products";
        return view("formulario", compact("product", "form"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, string $id)
    {
        $producto = Product::find($id);

        $image = $request->file('image');   
        $slug = Str::slug($request->nombre);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/productos/')) {
                mkdir('uploads/productos/', 0777, true);
            }

            $image->move('uploads/productos', $imagename);
        } else {
            $imagename = $producto->image;
        }

        $producto->update(array_merge($request->except("image"), [
            "image" => $imagename
        ]));

        return redirect()->route("products.index")->with("successMsg", "El registro se guardó exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el departamento: ' . $e->getMessage());
            return redirect()->route('products.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el departamento: ' . $e->getMessage());
            return redirect()->route('products.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadoproducto(Request $request) {
		$product = Product::find($request->id);
		$product->status=$request->estado;
		$product->save();
    }
}