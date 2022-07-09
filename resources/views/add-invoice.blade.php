@extends('layouts.app')

@section('add-invoice')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between">
            <h1 class="b">Invoice Form</h1>
            <div>
                <a href="/" class="btn btn-outline-primary"><i class="fa-solid fa-house"></i> Home</a>
            </div>
        </div>
        <div class="col-12">
            <form class="form" id="invoiceForm" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}" class="form-control">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="col-3"><input name="invoice_number" class="form-control border-0" type="text" placeholder="Invoice number here"></td>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3 align-items-center"><input name="invoice_date" class="form-control border-0" type="date" placeholder="Invoice date here" value="{{ \date('Y-m-d') }}"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3"><input class="form-control border-0" type="text" name="customer_name" placeholder="Customer name"></td>
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
                                <td class="col-3" colspan="2">Sub Total</td>
                            </tr>
                        </thead>
                        <tbody class="invoice-row">
                            <tr>
                                <td class="col-3">
                                    <input 
                                        class="form-control border-0" 
                                        type="text" 
                                        name="product_name[]" 
                                        placeholder="Name">
                                </td>
                                <td class="col-3">
                                    <input 
                                        class="form-control border-0 quantity" 
                                        type="text" 
                                        name="product_quantity[]" 
                                        placeholder="Quantity">
                                </td>
                                <td class="col-2">
                                    <input 
                                        class="form-control border-0 price" 
                                        type="text" 
                                        name="product_price[]" 
                                        placeholder="Price">
                                </td>
                                <td class="col-2 sub-total">
                                    <input 
                                        class="form-control border-0 amount" 
                                        width="" 
                                        name="amount[]" 
                                        type="text" 
                                        placeholder="Sub Total">
                                </td>
                                <td class="col sub-total">
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-danger remove-row"><i class="fa-solid fa-minus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="col-3"><button type="button" class="btn btn-outline-primary" id="addRow"><i class="fa-solid fa-plus"></i></button></td>
                                <td class="col-3"></td>
                                <td class="col-2"></td>
                                <td class="col-2"></td>
                                <td class="col-1"></td>
                            </tr>
                            <tr>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-2">Total</td>
                                <td class="col-2" id="totalAmount">0</td>
                                <td class="col-1"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button class="btn btn-outline-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection