<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Brands', 'List of all brands');

        return view('admin.brands.index', [
            'brands' => Brand::all()
        ]);
    }

    public function create()
    {
        $this->setPagetitle('Brands', 'Create new brand');

        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $validated = $request->validated();

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('brand');
        }

        Brand::create($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand Created Successfully');
    }

    public function edit(Brand $brand)
    {
        $this->setPagetitle('Brands', 'Edit Brand');

        return view('admin.brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $oldImage = $brand->image;
        $validated = $request->validated();

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('brand');
        }

        $brand->update($validated);

        if ($oldImage != $brand->image) {
            Storage::delete($oldImage);
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand Updated Successfully');
    }

    public function destroy(Brand $brand)
    {
        if (Storage::exists($brand->image)) {
            Storage::delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand Deleted Successfully');
    }
}
