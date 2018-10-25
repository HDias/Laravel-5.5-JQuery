# In `App\Exceptions\Handler` adicionar

````
public function render($request, Exception $exception)
    {
        if ($exception instanceof ForbiddenException &&  \App::environment('production')) {
            abort(403);
        }

        return parent::render($request, $exception);
    }
}
```

# Adcione o helper em `composer.json` e rode: `compose dumpautoload`

```
    "autoload": {
        "files": [
            ...
            "modules/ACL/helpers.php"
            ...
        ]
    }
```
