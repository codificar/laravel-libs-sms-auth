# sms-auth

Permite cadastro e login via sms

## Installation

Add in composer.json:

```php
"repositories": [
    {
        "type": "vcs",
        "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/sms-auth.git"
    }
]
```

```php
require:{
        "codificar/sms-auth": "1.1.0",
}
```

```php
"autoload": {
    "psr-4": {
        "Codificar\\Sms\\": "vendor/codificar/sms-auth/src/"
    },
}
```

Update project dependencies:

```shell
$ composer update
```

Register the service provider in `config/app.php`:

```php
'providers' => [
  /*
   * Package Service Providers...
   */
  Codificar\Sms\SmsServiceProvider::class,
],
```


Publish Js Libs and Tests:

```shell
$ php artisan vendor:publish --tag=public_vuejs_libs --force
```


Run the migrations:

```shell
$ php artisan migrate
```

# Observações

- Assume-se que existe o helper is_token_active
- Assume-se que existe o helper login_helper (ver fretes)