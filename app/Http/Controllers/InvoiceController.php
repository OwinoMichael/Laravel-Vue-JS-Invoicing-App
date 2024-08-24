<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function get_all_invoice() {

        $invoices = Invoice::with('customer')->orderBy('id', 'DESC')->get();

        return new JsonResponse([
            'invoices' => $invoices
        ], 200);
     }

     public function search_invoice(Request $request) {
        $search = $request->get('s');
        if($search != null){
         $invoices = Invoice::with('customer')
               ->where('id', 'LIKE', "%$search%")
               ->get();

               return new JsonResponse([
                     'invoice' => $invoices
               ], 200);
        } else {
             return $this->get_all_invoice();
        }
     }


//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(StoreInvoiceRequest $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Invoice $invoice)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Invoice $invoice)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(UpdateInvoiceRequest $request, Invoice $invoice)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Invoice $invoice)
//     {
//         //
//     }
 }
