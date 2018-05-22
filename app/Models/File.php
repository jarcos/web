<?php

namespace App\Models;

use App\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use SoftDeletes;

    /**
     * Max size. 5000 kilobytes
     */
    const MAX_SIZE = 20000;

    protected $fillable = [
        'title',
        'public',
        'file',
        'user_id',
        'extension',
        'description',
    ];

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
}
