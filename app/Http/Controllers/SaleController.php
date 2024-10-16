<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Inertia\Inertia;
use App\Models\Product; 
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('product')->get();
        $products = Product::all();
        $success = session('success');
        return Inertia::render('Sales/Index', compact('sales', 'products', 'success'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'sale_qty' => 'required|integer',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total_price = $product->price * $request->sale_qty;

        Sale::create([
            'product_id' => $product->id,
            'sale_qty' => $request->sale_qty,
            'total_price' => $total_price,
        ]);

        $product->update(['stock' => $product->stock - $request->sale_qty]);

        return redirect()->route('sales.index')->with('success', 'Sale added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
