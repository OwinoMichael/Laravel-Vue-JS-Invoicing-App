<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends Controller
{
    public function all_customers(){
        $customers = Customer::orderBy('id', 'DESC')->get();

        return new JsonResponse([
            'customers' => $customers
        ], 200);
    }
}
