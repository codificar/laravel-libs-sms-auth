# sms-auth

Permite cadastro e login via sms

## Getting Started

- In root of your Laravel app in the composer.json add this code to clone the project:

```

"repositories": [
    {
        "type": "package",
        "package": {
            "name": "codificar/sms-auth",
            "version": "1.0.3",
            "source": {
                "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/sms-auth.git",
                "type": "git",
                "reference": "1.0.3"
            }
        }
    }
],

// ...

"require": {
    // ADD this
    "codificar/sms-auth": "dev-master",
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
			"Codificar\\Sms\\": "vendor/codificar/sms-auth/src",
            "App\\": "app/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            // Add your Lib here
			"Codificar\\Sms\\": "vendor/codificar/sms-auth/src",
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
            Codificar\Sms\SmsServiceProvider::class
        ],
```

# Observações
- Assume-se que existe o helper is_token_active
- Assume-se que existe o helper login_helper (ver fretes)