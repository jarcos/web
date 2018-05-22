<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterConfig extends Model
{
    protected $table = 'shelters_config';

    protected $fillable = [
        'key',
        'value'
    ];

    public static $keys = [
        'lang',
        'langs',

        'web_disabled',
        'web_maintenance',

        'theme',
        'themes_default_color',
        'themes_default_borderradius',
        'themes_default_headerimage',
        'themes_default_logo',
        'themes_default_backgroundtype',
        'themes_default_backgroundimage',
        'themes_default_favicon',

        'animals_fields',
        'animals_contactemail',

        'posts_pagination',
    ];

    public static function getDefaults()
    {
        return [
            'lang' => 'es',
            'langs' => 'es,en',

            'web_disabled' => 0,
            'web_maintenance' => 0,

            'theme' => 'default',
            'themes_default_color' => '#25c2e6',
            'themes_default_borderradius' => 1,
            'themes_default_headerimage' => null,
            'themes_default_logo' => null,
            'themes_default_backgroundtype' => null,
            'themes_default_backgroundimage' => null,
            'themes_default_favicon' => null,

            'animals_fields' => json_encode(['name', 'birth_date', 'gender', 'kind', 'breed', 'status', 'location', 'health_text']),
            'animals_contactemail' => null,

            'posts_pagination' => 10,
        ];
    }
}
