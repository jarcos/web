<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Image;

class Animal extends BaseModel
{
    use SoftDeletes;

    const MAX_PHOTO_SIZE = 1000;
    const PHOTO_QUALITY = 90;
    const MAX_PHOTO_THUMBNAIL_SIZE = 600;
    const PHOTO_THUMBNAIL_QUALITY = 75;
    const PHOTO_THUMBNAIL_SMALL_QUALITY = 75;
    const MAX_PHOTO_THUMBNAIL_SMALL_SIZE = 200;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'old_name',
        'identifier',
        'visible_on_web',
        'microchip',
        'litter',
        'breed',
        'health_resume',
        'status',
        'kind',
        'gender',
        'location',
        'birth_date',
        'birth_date_approximate',
        'entry_date',
        'weight',
        'height',
        'length',
        'text',
        'meta',
        'temporary_home_id',
        'private_text',
        'photo',
        'photo_thumbnail',
        'photo_thumbnail_small'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'birth_date',
        'entry_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function health()
    {
        return $this->hasMany(AnimalHealth::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sponsorships()
    {
        return $this->hasMany(AnimalSponsorship::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function public_sponsorships()
    {
        return $this->hasMany(AnimalSponsorship::class)
            ->where('visible', 'visible')
            ->where('status', 'active');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(AnimalMedia::class)->where('type', 'photo');
    }
}
