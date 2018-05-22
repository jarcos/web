<?php

namespace App\Models;

class Shelter extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'contact_name',
        'contact_email',
        'contact_phone',
        'lang'
    ];

    /**
     * @param      $key
     * @param null $value
     *
     * @return null
     */
    public function getConfig($key, $value = null)
    {
        foreach ($this->config as $i => $config) {
            if ($config->key == $key) {
                return $this->config[$i]->value;
            }
        }

        return $value ?: null;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasConfig($key)
    {
        return $this->getConfig($key) ? true : false;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setConfig($key, $value)
    {
        if (! $this->config()->where('key', $key)->exists()) {
            $this->config()->create([
                'key'   => $key,
                'value' => $value,
            ]);
        } else {
            $this->config()->where('key', $key)->update([
                'value' => $value,
            ]);
        }

        return $this;
    }

    /**
     * @param array $config
     *
     * @param bool  $replace
     *
     * @return $this
     */
    public function setConfigs(array $config, bool $replace = true)
    {
        foreach ($config as $key => $value) {
            if (! $this->config()->where('key', $key)->exists()) {
                $this->config()->create([
                    'key'   => $key,
                    'value' => $value,
                ]);
            } elseif ($replace) {
                $this->config()->where('key', $key)->update([
                    'value' => $value,
                ]);
            }
        }

        return $this;
    }

    /**
     * @param $key
     *
     * @return $this
     */
    public function unsetConfig($key)
    {
        if ($config = $this->config()->where('key', $key)->first()) {
            $config->delete();
        }

        return $this;
    }

    /**
     * @param bool $subdomain
     *
     * @return string
     */
    public function getUrl(bool $subdomain = false) : string
    {
        if ($this->domain && ! $subdomain) {
            return 'http://'.$this->domain;
        }

        return 'http://'.$this->subdomain.'.'.env('APP_BASE_DOMAIN');
    }

    /**
     * @param bool $subdomain
     *
     * @return string
     */
    public function getImagesUrl(bool $subdomain = false) : string
    {
        if ($this->domain && ! $subdomain) {
            return 'http://'.$this->domain.'/'.static_url().'/'.$this->id.'/images/';
        }

        return "http://{$this->subdomain}.".env('APP_BASE_DOMAIN')."/".static_url()."/{$this->id}/images/";
    }

    /**
     * @param bool $subdomain
     *
     * @return string
     */
    public function getUploadsUrl(bool $subdomain = false) : string
    {
        if ($this->domain && ! $subdomain) {
            return 'http://'.$this->domain.'/'.static_url().'/'.$this->id.'/uploads/';
        }

        return "http://{$this->subdomain}.".env('APP_BASE_DOMAIN')."/".static_url()."/{$this->id}/uploads/";
    }

    /**
     * @return string
     */
    public function getImagesPath() : string
    {
        return public_path("static/{$this->id}/images/");
    }

    /**
     * @return string
     */
    public function getUploadsPath() : string
    {
        return public_path("static/{$this->id}/uploads/");
    }

    /**
     * @param int    $animalId
     * @param string $photo
     *
     * @return string
     */
    public function getAnimalPhotoUrl(int $animalId, string $photo)
    {
        return static_url() . "{$this->id}/animals/{$animalId}/photos/{$photo}";
    }

    /**
     * @return bool
     */
    public function isWebInMaintenance()
    {
        return $this->getConfig('web_maintenance', false);
    }

    /**
     * @return bool
     */
    public function isWebDisabled()
    {
        return $this->getConfig('web_disabled', false);
    }

    /**
     * @throws \Exception
     */
    public function clearConfigCache()
    {
        cache()->forget('shelter.'.$this->domain);
        cache()->forget('shelter.'.$this->subdomain);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function config()
    {
        return $this->hasMany(ShelterConfig::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts_categories()
    {
        return $this->hasMany(PostCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function veterinarians()
    {
        return $this->hasMany(Veterinarian::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temporaryhomes()
    {
        return $this->hasMany(TemporaryHome::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendar()
    {
        return $this->hasMany(Calendar::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
