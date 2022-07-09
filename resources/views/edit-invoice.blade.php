@extends('layouts.app')

@section('add-invoice')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between">
            <h1>Invoice Form</h1>
            <div>
                <a href="/" class="btn btn-outline-primary"><i class="fa-solid fa-house"></i> Home</a>
            </div>
        </div>
        <div class="col-12">
            <form class="form" id="invoiceForm" method="PUT" data-id="{{ encrypt($id) }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" class="form-control">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="col-3"><input value="{{$invoice_number}}" name="invoice_number" class="form-control border-0" type="text" placeholder="Invoice number here"></td>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3 align-items-center"><input name="invoice_date" class="form-control border-0" type="date" placeholder="Invoice date here" value="{{ date_format(date_create($invoice_date), 'Y-m-d') }}"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3"><input value="{{ $customer_name }}" class="form-control border-0" type="text" name="customer_name" placeholder="Customer name"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="col-3">Product Name</td>
                                <td class="col-3">Quantity</td>
                                <td class="col-3">Price</td>
                                <td class="col-3">Sub Total</td>
                            </tr>
                        </thead>
                        <tbody class="invoice-row">
                            <tr>
                                <td class="col-3">
                                    <input 
                                        class="form-control border-0" 
                                        type="text" 
                                        name="product_name" 
                                        placeholder="Name"
                                        value="{{ $product_name }}">
                                </td>
                                <td class="col-3">
                                    <input 
                                        class="form-control border-0 quantity" 
                                        type="text" 
                                        name="product_quantity" 
                                        placeholder="Quantity"
                                        value="{{ $product_quantity }}">
                                </td>
                                <td class="col-2">
                                    <input 
                                        class="form-control border-0 price" 
                                        type="text" 
                                        name="product_price" 
                                        placeholder="Price"
                                        value="{{ $product_price }}">
                                </td>
                                <td class="col-2 sub-total">
                                    <input 
                                        class="form-control border-0 amount" 
                                        width="" 
                                        name="amount" 
                                        type="text" 
                                        placeholder="Sub Total"
                                        value="{{ $amount }}">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="col-3"><p></p></td>
                                <td class="col-3"></td>
                                <td class="col-2"></td>
                                <td class="col-2"></td>
                            </tr>
                            <tr>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-2">Total</td>
                                <td class="col-2" id="totalAmount">{{ $amount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button class="btn btn-outline-success" type="submit" id="submitInvoice">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection