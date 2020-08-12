# sms-auth

Permite cadastro e login via sms

## Getting Started

- In root of your Laravel app in the composer.json add this code to clone the project:

```

"repositories": [
    {
        "type": "package",
        "package": {
            "name": "codificar/laravel-themes",
            "version": "1.0.1",
            "source": {
                "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/laravel-themes.git",
                "type": "git",
                "reference": "1.0.1"
            }
        }
    }
],

// ...

"require": {
    // ADD this
    "codificar/laravel-themes": "dev-master",
},

```

- Add 
```

"autoload": {
        "classmap": [
            "database/seeds"
        ],
        "psr-4": {
            // Add your Lib here
			"Codificar\\Themes\\": "vendor/codificar/laravel-themes/src",
            "App\\": "app/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            // Add your Lib here
			"Codificar\\Themes\\": "vendor/codificar/laravel-themes/src",
            "Tests\\": "tests/"
        }
    },
```
- Dump the composer autoloader

```
composer dump-autoload -o
```

- Next, we need to add our new Service Provider in our `config/app.php` inside the `providers` array:

```
'providers' => [
         ...,
            // The new package class
            Codificar\Themes\ThemeServiceProvider::class
        ],
```

# Observações
- Assume-se que existe o helper is_token_active
- Assume-se que existe o método api\v1\ProviderLoginController@validateLogin() (ver uberfretes)