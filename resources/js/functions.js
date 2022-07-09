// const baseUrl = 'http://localhost:8000/';

function Toast() {
    return Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}


export function addRow(e) {
    $('.invoice-row tr:last-child').clone().appendTo('.invoice-row');
    $('.invoice-row tr:last-child input').val('');
}

export function removeRow(e){
    if ($('.invoice-row tr').length > 1) {
        $(this).parents('tr').remove();
    }
    calculateTotalAmount();
}

export function deleteInvoice(e) {
    var invoiceNumber = $(this).parents('tr').find('td:first-child').text();
    var id = $(this).data('id');
    $.ajax({
        url: '/invoices/' + id,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'DELETE',
        error: function(err) {
            Swal.fire({
                title: 'Error!',
                text: err.responseText,
                icon: 'error',
                confirmButtonText: 'Ok',    
                heightAuto: false,
                buttonsStyling: true,
                width: ''
            });
        },
        success: function(res) {
            Toast().fire({
                icon: 'success',
                title: `Successfully remove invoice ${invoiceNumber}`
            });
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        }
    });
}

export function submitForm(e) {
    e.preventDefault();
    var method = $(this).attr('method');
    var inputs = $('#invoiceForm .form-control');
    var form = inputs.serialize();
    console.log(form);
    $.ajax({
        url: method == 'POST' ? '/invoices' : '/invoices/'+$(this).data('id'),
        data: form,
        type: method,
        error: function(err) {
            // console.log(err);
            Swal.fire({
                title: 'Error!',
                text: err.responseText,
                icon: 'error',
                confirmButtonText: 'Ok',    
                heightAuto: false,
                buttonsStyling: true,
                width: ''
            });
        },
        success: function(res) {
            // console.log(res);
            Toast().fire({
                icon: 'success',
                title: method == 'POST' ? 'New Invoice Added Succesffuly' : 'Update Invoice Successfully'
            });
            setTimeout(() => {
                window.location.href = '/';
            }, 3000);
        }
    });  
}

export function clearInput(input) {
    input.map(function(e){
        console.log(e);
    })
}

export function calculateSubTotal(e) {
    var row = $(this).parents('tr');
    var quantity = row.find('.quantity').val();
    var price = row.find('.price').val();

    row.find('.sub-total input').val(quantity * price);
    calculateTotalAmount();
}

export function calculateTotalAmount() {
    var totalamount = 0;

    $('.amount').each(function(key){
        totalamount += parseInt($(this).val());
    });
    $('#totalAmount').html(totalamount);
}

export function loadInvoices() {
    $('#invoiceList').DataTable({
        ajax: {
            url: '/invoices',
            dataSrc: 'data'
        },
        columns: [
            {data: 'invoice_number'},
            {data: 'customer_name'},
            {data: 'product_name'},
            {data: 'product_quantity'},
            {data: 'product_price'},
            {data: 'amount'},
            {data: 'invoice_date'},
            {render: function(data, type, row) {
                var removeBtn = `<button data-id='${row['id']}' class="btn btn-outline-danger removeInvoice"><i class="fa-solid fa-trash"></i></button>`;
                var addBtn = `<a href='/invoices/edit/${row['id']}' class="mt-1 mt-xl-0 btn btn-outline-primary editInvoice"><i class="fa-solid fa-pen"></i></a>`;
                return `${removeBtn} ${addBtn}`;
            }},
        ]
    });
}