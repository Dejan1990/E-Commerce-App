<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;

class ProductController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Products', 'Products List');

        return view('admin.products.index', [
            'products' => Product::with(['categories', 'brand'])->get()
        ]);
    }

    public function create()
    {
        $this->setPagetitle('Products', 'Create Product');

        return view('admin.products.create', [
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated() + [
            'status' => $request->filled('status'),
            'featured' => $request->filled('featured')
        ]);

        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Created Successfully');
    }

    public function edit(Product $product)
    {
        $this->setPagetitle('Products', 'Edit Product');

        return view('admin.products.edit', [
            'product' => $product,
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated() + [
            'status' => $request->filled('status'),
            'featured' => $request->filled('featured')
        ]);

        $product->categories()->sync($request->categories);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
