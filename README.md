# Osaris UK - App Settings

## About

This package integrates a simple way to store your Laravel app settings in your database.

After running the migrations, you are ready to start using the package.

_If your application does not support auto-discovery you will need to register the service provider in `config/app.php`:_

```php
'providers' => [
    ...
    OsarisUk\AppSettings\AppSettingsServiceProvider::class,
]
```

## Model

The model for this package includes the mandatory field `key`, the `value` field is nullable.  There are also several other optional fields included on this model to aid in creating a user interface, these fields are:
```
description // Nullable
type // Default = 'text'
validation_rules // Nullable
options // Nullable
group // Nullable
```

The only fields that are cached for use with the `setting()` helper are `key` & `value`.

## Helper

This package includes a helper to access settings anywhere in your app using the defined key for your desired setting:

```php
setting('app_name')
```

To update or create a new setting you can pass a value as the second argument:

```php
setting('app_name', 'Pattern')
```

You can also directly access the class by passing no arguments through.  This is useful to access the other methods on the model, for example:

```php
setting()->getAllCachedSettings()
```
## Available Methods

```php
setting()->getAllCachedSettings() // Returns collection of all cached settings
setting()->settingExists($key) // Returns true / false
setting()->getCachedValue($key) // Returns setting value
setting()->setCachedValue($key, $value) // Returns new setting value
setting()->remove($key) // Returns true / false  (Sets value to null & soft deletes the record)
setting()::clearCache() // Returns true / false
```

The model watches for the `created`, `updated` & `deleted` events and triggers  `setting()::clearCache()` for each of these.