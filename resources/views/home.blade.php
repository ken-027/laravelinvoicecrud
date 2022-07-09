@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @include('layouts.add-invoice') --}}
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Invoice List</h1>
            <div>
                <a href="/invoices/add" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i> New Invoice</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped table-hover" id="invoiceList">
                    <thead class="table-success">
                        <tr>
                            <td>Invoice Number</td>
                            <td>Customer Name</td>
                            <td>Product Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Amount</td>
                            <td>Invoice Date</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
    
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
