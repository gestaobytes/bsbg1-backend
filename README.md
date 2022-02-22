<p align="center"><img src="https://drive.google.com/uc?export=view&id=13dNVnvnBqSXD87lBuIrVTUN7Gd-H7_1T"></p>
<hr/>

## Sobre

O **eJornal** é o FrameWork para novos projetos de Portais de Notícias da GestãoBytes com o BackEnd e FrontEnd separados. O BackEnd é desenvolvido em Laravel e o FrontEnd em Vue.js com a biblioteca do Vuetify.

## Requisitos

"php": "^7.2.5",
"laravel/framework": "^7.0",


* **BACKEND**; 
    - PHP >= 7.2.5;
    - Laravel 7.0;
    - JWT AUTH 1.0;

## Seguir as etapas listadas abaixo:

* **BACKEND**; 
    - Criar o arquivo .env
    - Faça as seguintes alterações no **bootstrap/app.php**:
        - Descomente a linha **$app->register(App\Providers\AuthServiceProvider::class);**
        - Descomente a linha **'auth' => App\Http\Middleware\Authenticate::class;**
        - Adicione a linha **$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);**
    - Gerar o JWT Key (`php artisan jwt:secret`)
    - Configurar **config/cors.php** conforme a necessidade do projeto
    - Adicionar no **config/auth.php** ou ainda alterar o arquivo **\vendor\laravel\laravel-lumen\config\auth.php** substituindo pelo seguinte código:

    ```php
    return [
        'defaults' => [
            'guard' => env('AUTH_GUARD', 'api'),
        ],
        'guards' => [
            'api' => [
                'driver' => 'jwt',
                'provider' => 'users'
            ],
        ],
        'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model'  => \App\Models\User::class,
            ],
        ],
        'passwords' => [ ],
    ];
    ```

    - Alterar o trecho de código em **app\Providers\AuthServiceProvider** para:
   
    ```php
    $this->app['auth']->viaRequest('api', function ($request)
    {
        return \App\Model\User::where('email', $request->input('email'))->first();
        /* atenção para o local da pasta onde se encontra a model User */
    });
    ```

## Licença

Este projeto é de uso exclusivo da **[Gestão Bytes](https://www.gestaobytes.com)**. O uso sem o consentimento da empresa pode acarretar em processos judiciais.
