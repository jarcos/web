<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimalSponsorship extends Model
{
    use SoftDeletes;

    protected $table = 'animals_sponsorships';

    protected $fillable = [
        'animal_id',
        'name',
        'email',
        'phone',
        'address',
        'donation',
        'visible',
        'status',
        'donation_time',
        'payment_method',
        'start_date',
        'end_date',
        'text',
        'text',
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
