<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $mode = "clients";
        $modeEs = "Clientes";
        // return view("clients.index", compact("clients"));
        return view("listar", compact("clients", "mode", "modeEs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("formulario", ["form" => "clients", "client" => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        $photo = $request->file("photo");
        $slug = Str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clientes/')) {
                mkdir('uploads/clientes/', 0777, true);
            }

            $image->move('uploads/clientes', $imagename);
        } else {
            $imagename = "";
        }

        $cliente = Client::create(array_merge($request->except("photo"), [
            "photo" => $imagename
        ]));

        return redirect()->route("clients.index")->with("successMsg", "El registro se guardó correctamente");
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
        $client = Client::find($id);
        $form = "clients";
        return view("formulario", compact("client", "form"));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ClienteRequest $request, $id)
    {
        // Buscar el cliente por su ID
        $client = Client::findOrFail($id);

        // Actualizar los datos básicos
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->address = $request->input('address');
        $client->document = $request->input('document');

        // Lógica para manejar la foto
        if ($request->hasFile('photo')) {
            // Obtener la imagen
            $photo = $request->file('photo');
            $currentDate = Carbon::now()->toDateString();
            $photoname = $client->slug . '-' . $currentDate . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();

            // Crear la carpeta si no existe
            if (!file_exists('uploads/clientes/')) {
                mkdir('uploads/clientes/', 0777, true);
            }

            // Mover la foto al directorio adecuado
            $photo->move('uploads/clientes', $photoname);

            // Si ya existe una foto, eliminarla
            if ($client->photo && file_exists('uploads/clientes/' . $client->photo)) {
                unlink('uploads/clientes/' . $client->photo);
            }

            // Asignar el nuevo nombre de la foto al cliente
            $client->photo = $photoname;
        }

        // Asignar el usuario que está realizando la actualización
        $client->registered_by = Auth::id(); // Usamos Auth::id() para obtener el ID del usuario autenticado

        // Establecer el estado en 1 (activo) si es necesario
        $client->status = 1;

        // Guardar los cambios
        $client->save();

        // Redirigir a la vista de listado de clientes con un mensaje de éxito
        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cambioestadocliente() {}
}
