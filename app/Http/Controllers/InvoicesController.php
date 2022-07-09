<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoices::all()->toArray();
        array_walk($invoices, function(&$value, $key){
            $value['id'] = encrypt($value['id']);
        });
        return response(["data" => $invoices], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'invoice_date' => 'required|date',
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'product_name' => 'required|array',
            'product_price' => 'required|array',
            'product_quantity' => 'required|array',
            'amount' => 'required|array',
        ]);

        $created = [];
        foreach ($validated['product_name'] as $index => $value) {
            $new_param = $validated;
            $new_param['product_name'] = $validated['product_name'][$index];
            $new_param['product_price'] = $validated['product_price'][$index];   
            $new_param['product_quantity'] = $validated['product_quantity'][$index];
            $new_param['amount'] = $validated['amount'][$index];
            $created[$index] = Invoices::create($new_param);
        }
        return response($created, 201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'invoice_date' => 'required|date',
            'invoice_number' => 'required',
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        $id = decrypt($id);
        Invoices::find($id)->update($validated);
        return response(Invoices::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response(Invoices::find(decrypt($id))->delete(), 200);
    }

    public function add_invoice() {
        return view('add-invoice');
    }

    public function edit_invoice($id) {
        $invoice = Invoices::find(decrypt($id));
        return view('edit-invoice', $invoice);
    }
}
