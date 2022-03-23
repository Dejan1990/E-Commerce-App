<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    public function loadAttributes()
    {
        $attributes = Attribute::all();

        return response()->json($attributes);
    }

    public function productAttributes(Request $request)
    {
        $product = Product::findOrFail($request->id);

        return response()->json($product->attributes);
    }

    public function loadAttributeValues(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);

        return response()->json($attribute->values);
    }

    public function addProductAttribute(Request $request)
    {
        ProductAttribute::create($request->data);

        return response()->json([
            'message' => 'Product attribute added successfully.'
        ]);
    }

    public function deleteProductAttribute(Request $request)
    {
        $productAttribute = ProductAttribute::findOrFail($request->id);

        $productAttribute->delete();

        return response()->json([
            'status' => 'success', 
            'message' => 'Product attribute deleted successfully.'
        ]);
    }
}

       