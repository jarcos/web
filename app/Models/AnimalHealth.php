<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimalHealth extends Model
{
    use SoftDeletes;

    protected $table = 'animals_health';

    protected $fillable = [
        'animal_id',
        'veterinarian_id',
        'title',
        'type',
        'medicine',
        'finish_text',
        'start_date',
        'end_date',
        'cost',
        'treatments_number',
        'treatments_each',
        'treatments_time',
        'treatments_life',
        'test_result',
        'hidden_in_calendar',
        'text',
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    /**
     * @param $value
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    /**
     * @param $value
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
