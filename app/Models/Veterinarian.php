<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veterinarian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact_name',
        'email',
        'phone',
        'emergency_phone',
        'status',
        'address',
        'text'
    ];
}
