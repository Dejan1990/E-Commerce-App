<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        if ($request->file('image')) {
            $request->image = $request->file('image')->store('product');
        }

        $product = Product::find($request->product_id);

        $product->images()->create([
            'image' => $request->image
        ]);

        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = ProductImage::find($id);

        if (Storage::exists($image->image)) {
            Storage::delete($image->image);
        }

        $image->delete();

        return back();
    }
}
