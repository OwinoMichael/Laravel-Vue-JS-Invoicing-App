<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Counter;
use App\Models\InvoiceItem;
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

     public function create_invoice(Request $request){
        $counter = Counter::where('key', 'invoice')->first();
        $random = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();
        if($invoice){
            $invoice = $invoice->id+1;
            $counters = $counter->value + $invoice;
        }else{
            $counters = $counter->value;
        }

        $formData = [
                    'number' => $counter->prefix.$counters,
                    'customer_id' => null,
                    'date' => date('Y-m-d'),
                    'due_date' => null,
                    'reference' => null,
                    'discount' => 0,
                    'terms_and_conditions' => 'Default Terms and Conditions',
                    'items' => [
                        [
                            'product_id' => null,
                            'product' => null,
                            'unit_price' => 0,
                            'quantity' => 0,
                        ]
                    ]

                ];

        return new JsonResponse($formData);



    }

    public function add_invoice(Request $request){
        $invoiceitem = $request->input("invoice_item");

        $invoicedata['sub_total'] = $request->input("subtotal");
        $invoicedata['total'] = $request->input("total");
        $invoicedata['customer_id'] = $request->input("customer_id");
        $invoicedata['number'] = $request->input("number");
        $invoicedata['date'] = $request->input("date");
        $invoicedata['due_date'] = $request->input("due_date");
        $invoicedata['discount'] = $request->input("discount");
        $invoicedata['reference'] = $request->input("reference");
        $invoicedata['terms_and_conditions'] = $request->input("terms_and_conditions");

        $invoice = Invoice::create($invoicedata);

        foreach (json_decode($invoiceitem) as $item){
            $itemsdata['product_id'] = $item->id;
            $itemsdata['invoice_id'] = $invoice->id;
            $itemsdata['quantity'] = $invoice->id;
            $itemsdata['unit_price'] = $invoice->id;
            $itemsdata['invoice_id'] = $invoice->id;

            InvoiceItem::create($itemsdata);
        }

    }

    public function show_invoice($id){
       $invoice = Invoice::with(['customer', 'invoice_items.product'])->find($id);
       return new JsonResponse([
        'invoice' => $invoice
       ], 200);  
    }

    public function edit_invoice($id){
        $invoice = Invoice::with(['customer', 'invoice_items.product'])->find($id);
       return new JsonResponse([
        'invoice' => $invoice
       ], 200); 
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
