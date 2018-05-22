<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $table = 'forms_fields';

    protected $fillable = [
        'title',
        'order',
        'name',
        'type',
        'required'
    ];
}
