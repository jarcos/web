<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use SoftDeletes;
}
