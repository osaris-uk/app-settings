<?php

namespace OsarisUk\AppSettings\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{
    use SoftDeletes;
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            self::clearCache();
        });

        static::updated(function () {
            self::clearCache();
        });

        static::deleted(function() {
            self::clearCache();
        });
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Cache key.
     *
     * @var string
     */
    protected static $cacheKey = 'app_settings';

    /**
     * Get all settings as key value pair.
     *
     * @return Collection
     */
    public function getAll()
    {
        return Cache::rememberForever(self::$cacheKey, function () {
            return $this->pluck('value', 'key');
        });
    }

    /**
     * Get a setting by key.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->getAll()->get($key);
    }

    /**
     * Save or update a setting.
     *
     * @param string $key
     * @param string|mixed $value
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        return $this->get($key);
    }

    /**
     * Remove a setting.
     *
     * @param string $key
     * @return bool
     */
    public function remove($key)
    {
        if($setting = $this->where('key', $key)->first()) {
            return $setting->delete();
        }

        return false;
    }

    /**
     * Clear settings cache.
     *
     * @return bool
     */
    public static function clearCache()
    {
        return Cache::forget(self::$cacheKey);
    }
}
