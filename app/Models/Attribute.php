<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'slug', 'frontend_type', 'is_filterable', 'is_required'];

    protected $casts  = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
    ];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
