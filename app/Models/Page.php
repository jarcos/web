<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'fixed',
        'status',
        'category_id',
        'user_id',
        'form_id',
        'published_at',
        'text',
    ];

    protected $dates = [
        'published_at'
    ];

    /**
     * @param $value
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
