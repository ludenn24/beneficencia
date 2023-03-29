<?php
use Respect\Validation\Validator as v;
use Slim\Http\UploadedFile;

session_start();

require __DIR__ . '/../vendor/autoload.php';


$settings = require 'settings.php';
$app = new \Slim\App($settings);
$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\AuthController($container);
};

$container['AdminController'] = function ($container) {
    return new \App\Controllers\AdminController($container);
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['OllasController'] = function ($container) {
    return new \App\Controllers\OllasController($container);
};

$container['FormularioController'] = function ($container) {
    return new \App\Controllers\FormularioController($container);
};

$container['MenuCategoriaController'] = function ($container) {
    return new \App\Controllers\MenuCategoriaController($container);
};

$container['MenuItemController'] = function ($container) {
    return new \App\Controllers\MenuItemController($container);
};

$container['NoticiaController'] = function ($container) {
    return new \App\Controllers\NoticiaController($container);
};

$container['PaginasController'] = function ($container) {
    return new \App\Controllers\PaginasController($container);
};

$container['EventoController'] = function ($container) {
    return new \App\Controllers\EventoController($container);
};

$container['AlquilerController'] = function ($container) {
    return new \App\Controllers\AlquilerController($container);
};

$container['MesaController'] = function ($container) {
    return new \App\Controllers\MesaController($container);
};

$container['PopupController'] = function ($container) {    
    return new \App\Controllers\PopupController($container);
};

$container['SeccionesController'] = function ($container) {    
    return new \App\Controllers\SeccionesController($container);
};

$container['csrf'] = function ($container) {
    // return new \Slim\Csrf\Guard;
    $guard = new \Slim\Csrf\Guard();
    $guard->setPersistentTokenMode(true);
    return $guard;
};

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);


require __DIR__ . '/../app/routes.php';