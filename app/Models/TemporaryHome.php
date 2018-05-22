<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemporaryHome extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'text'
    ];
}
