<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function getInputOptionsAttribute()
    {
        $input_options = [];
        if (!empty($this->attributes['input_options'])) {
            $input_options_value = $this->attributes['input_options'];
            if (is_string($input_options_value)) {
                $input_options = explode(",", $input_options_value);
            } else {
                $input_options = $input_options_value;
            }
        }
        return $this->attributes['input_options'] = $input_options;
    }
}
