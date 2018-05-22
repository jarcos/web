<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    public function getColorAttribute()
    {
        switch ($this->type) {
            case 'transport':
                return '#F44336';
                break;
            case 'vaccine':
                return '#C2185B';
                break;
            case 'revision':
                return '#9C27B0';
                break;
            case 'treatment':
                return '#2196F3';
                break;
            case 'work':
                return '#4CAF50';
                break;
            case 'visit':
                return '#FF9800';
                break;
            case 'other':
                return '#00BCD4';
                break;
            default:
                return '#2196F3';
                break;
        }
    }
}
