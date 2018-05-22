<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'email',
        'status',
        'user_id',
        'subject',
        'text'
    ];

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
