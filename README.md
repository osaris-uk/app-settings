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
setting()->getAll()
```
## Available Methods

```php
setting()->getAll()
setting()->get($key)
setting()->set($key, $value) // Returns new value
setting()->remove($key) // Returns true / false
setting()::clearCache() // Returns true / false
```

The model watches for the `created`, `updated` & `deleted` events and triggers  `setting()::clearCache()` for each of these.