<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimalMedia extends BaseModel
{
    use SoftDeletes;

    protected $table = 'animals_media';

    protected $fillable = [
        'type',
        'url',
        'thumbnail',
        'thumbnail_small'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
