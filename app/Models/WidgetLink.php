<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetLink extends Model
{
    protected $table = 'widgets_links';

    protected $fillable = [
        'title',
        'link',
        'type',
        'order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
