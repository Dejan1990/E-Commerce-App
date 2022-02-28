<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
   /* public function getValues(Request $request)
    {
        $attributeId = $request->get('id');
        $attribute = Attribute::where('id', $attributeId)->first();
        $values = $attribute->values;

        return response()->json($values);
    }*/

    public function getValues(Attribute $attribute)
    {
        $value = $attribute->values;

        return response()->json($value);
    }

    public function addValue(Request $request, Attribute $attribute)
    {
        $value = AttributeValue::create($request->validate([
            'value' => ['required', 'string', 'min:3']
        ]) + ['attribute_id' => $attribute->id]);

        return response()->json($value);
    }

    public function updateValue(Request $request, Attribute $attribute)
    {
        $attributeValue = AttributeValue::findOrFail($request->get('valueId'));

        $value = $attributeValue->update($request->validate([
            'value' => ['required', 'string', 'min:3']
        ]));

        return response()->json($value);
    }

    public function deleteValue(Request $request, Attribute $attribute)
    {
        $attributeValue = AttributeValue::findOrFail($request->get('valueId'));
        $attributeValue->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Attribute value deleted successfully.'
        ]);
    }
}
