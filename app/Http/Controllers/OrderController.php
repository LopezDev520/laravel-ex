<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $mode = "orders";
        $modeEs = "Ordenes";
        // return view("orders.index", compact("orders"));
        return view("listar", compact("orders", "mode", "modeEs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where("status", "=", "1")->orderBy("name")->get();
        $clients = Client::where("status", "=", "1")->orderBy("name")->get();
        return view("orders.create", compact("clients", "products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {
            print($request);

            $order = Order::create([
                'date' => Carbon::now()->toDateTimeString(),
                'total' => $request->total,
                'route' => "Por hacer",
                'client_id' => Client::find($request->client_id)->id,
                'status' => 1,
                'registered_by' => $request->registered_by
            ]);

            $rawProductId = $request->product_id;
            $rawQuantity = $request->quantity;

            for ($i = 0; $i < count($rawProductId); $i++) {
                if ($rawProductId[$i] != -1 && $rawQuantity[$i] > 0) { // Validación adicional
                    $product = Product::find($rawProductId[$i]);
                    $quantity = $rawQuantity[$i];

                    $order->order_details()->create([
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        "subtotal" => $quantity * $product->price,
                        "registered_by" => $request->registered_by
                    ]);
                }
            }

            $order->save();

            // Generate bill (PDF).
            $pdfName = 'uploads/bills/bill_' . $order->id . '_' . Carbon::now()->format('YmdHis') . '.pdf';

            $order = Order::find($order->id);
            // Convertir date_order a DateTime si es una cadena
            if (is_string($order->date)) {
                $order->date = new \DateTime($order->date);
            }
            $client = Client::where("id", $order->client_id)->first();
            $details = OrderDetail::with('product')
                ->where('order_id', '=', $order->id)
                ->get();

            $pdf = PDF::loadView('orders.bill', compact("order", "client", "details"))
                ->setPaper('letter')
                ->output();

            file_put_contents($pdfName, $pdf);

            $order->route = $pdfName;
            $order->save();

            DB::commit();

            return redirect()->route("orders.index")->with("success", "The orders has been created.");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("success", $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cambioestadoorden() {}
}
