<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AttributeRequest;

class AttributeController extends BaseController
{
    public function index()
    {
        $this->setPagetitle('Attributes', 'Manage Atrributes');

        return view('admin.attributes.index', [
            'attributes' => Attribute::all()
        ]);
    }

    public function create()
    {
        $this->setPagetitle('Attribute', 'Create Attribute');

        return view('admin.attributes.create');
    }

    public function store(AttributeRequest $request)
    {
       Attribute::create($request->validated() + [
            'is_filterable' => $request->filled('is_filterable'),
            'is_required' => $request->filled('is_required')
        ]);

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Created Successfully.');
    }

    public function edit(Attribute $attribute)
    {
        $this->setPagetitle('Attributes', 'Edit Attribute');

        return view('admin.attributes.edit', [
            'attribute' => $attribute
        ]);
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated() + [
            'is_filterable' => $request->filled('is_filterable'),
            'is_required' => $request->filled('is_required')
        ]);

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Updated Successfully.');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Deleted Successfully.');
    }
}
