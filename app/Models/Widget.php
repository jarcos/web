<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'title',
        'text',
        'file',
        'status',
        'side',
        'order',
        'type',
        'config'
    ];

    protected $casts = [
        'config' => 'array'
    ];

    /**
     * @param $config
     *
     * @return mixed
     */
    public function getConfig($config)
    {
        if (isset($this->config[$config])) {
            return $this->config[$config];
        }
    }

    /**
     * @param $request
     */
    public function setConfigAttribute($request)
    {
        if ($request !== '0') {
            $config = $this->config;
            foreach ($request as $key => $value) {
                if ((bool) $value) {
                    $config[$key] = $value;
                } else {
                    unset($config[$key]);
                }
            }
            $this->attributes['config'] = json_encode($config);
        }
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function web()
    {
        return $this->belongsTo(Shelter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(WidgetLink::class);
    }
}
