require('./bootstrap');

import {
    addRow,
    removeRow,
    submitForm,
    calculateSubTotal,
    loadInvoices,
    deleteInvoice,
} from './functions';

$(document).ready(function(){
    $(this).on('click', '#addRow', addRow);
    $(this).on('click', '.remove-row', removeRow);
    $(this).on('submit', '#invoiceForm', submitForm);
    $(this).on('blur', '.quantity, .price, .amount', calculateSubTotal);
    $(this).on('click', '.removeInvoice', deleteInvoice);
    loadInvoices();
});
