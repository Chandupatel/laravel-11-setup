<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'active_cases', 'icon', 'route_name', 'route_params', 'is_multi_level', 'status'];

    public function sub_modules()
    {
        return $this->hasMany(Module::class, 'parent_id');
    }

    public function parent_module()
    {
        return $this->belongsTo(Module::class, 'parent_id');
    }
}
