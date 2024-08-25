<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function all_products(){
        $prodcuts = Products::orderBy('id', 'DESC')->get();
        return new JsonResponse([
            'products' => $prodcuts
        ], 200);
    }
}
