<?php

if (! function_exists('setting')) {
    function setting($key = null, $value = null)
    {
        if (is_null($key)) {
            return app()->make('OsarisUk\AppSettings\Models\AppSetting');
        }

        if(is_null($value)) {
            return app()->make('OsarisUk\AppSettings\Models\AppSetting')->get($key);
        }
        
        return app()->make('OsarisUk\AppSettings\Models\AppSetting')->set($key, $value);
    }
}
