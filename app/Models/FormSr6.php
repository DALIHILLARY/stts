<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSr6 extends Model
{
    use HasFactory;

    function __construct() {
 
    }

  
    public function form_sr6_has_crops()
    {
        return $this->hasMany(FormSr6HasCrop::class, 'form_sr6_id');
    }


}
