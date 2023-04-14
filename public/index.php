<?php

use App\services\UserService;
use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use League\Plates\Engine;
use function Tamtamchik\SimpleFlash\flash;
if( !session_id() ) {
    session_start();
}
require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();

$containerBuilder->addDefinitions([
    Engine::class=>function(){
        return new Engine('../src/views');
    },
    PDO::class=>function(){
        return new PDO("mysql:host=localhost;dbname=merli1;charset=utf8",'root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
    },
    Auth::class => function($container){
        return new Auth($container->get('PDO'));
    },
    QueryFactory::class => function(){
        return new QueryFactory('mysql');
    }
]);

$container = $containerBuilder->build();
$auth = $container->get(Auth::class);
//d($auth->hasRole(\Delight\Auth\Role::ADMIN));
//die();

//Routes
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    if ($_SESSION['auth_logged_in']){
        $r->addRoute('GET', '/', ['App\controllers\HomeController','index']);

        if ($_SESSION['auth_roles']==\Delight\Auth\Role::ADMIN||
            $_SESSION['auth_roles']==\Delight\Auth\Role::MANAGER
        ){
            $r->addRoute('GET', '/users', ['App\controllers\UserController', 'index']);
            //$r->addRoute('GET', '/users[/{page:\d+}]', ['App\controllers\UserController', 'index']);
            $r->addRoute('GET', '/user/{id:\d+}', ['App\controllers\UserController', 'show']);
            $r->addRoute('GET', '/user/{id:\d+}/edit', ['App\controllers\UserController', 'edit']);
            $r->addRoute('GET', '/user/create', ['App\controllers\UserController', 'create']);
            $r->addRoute('POST', '/user/store', ['App\controllers\UserController', 'store']);
            $r->addRoute('POST', '/user/delete', ['App\controllers\UserController', 'delete']);

            // The /{title} suffix is optional
            $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
        }
        if ($_SESSION['auth_roles']==\Delight\Auth\Role::ADMIN||
            $_SESSION['auth_roles']==\Delight\Auth\Role::MANAGER||
            $_SESSION['auth_roles']==\Delight\Auth\Role::COORDINATOR
        ){
            $r->addRoute('GET', '/users', ['App\controllers\UserController', 'index']);
            //$r->addRoute('GET', '/users[/{page:\d+}]', ['App\controllers\UserController', 'index']);
            $r->addRoute('GET', '/user/{id:\d+}', ['App\controllers\UserController', 'show']);
            $r->addRoute('GET', '/user/{id:\d+}/edit', ['App\controllers\UserController', 'edit']);
            $r->addRoute('GET', '/user/create', ['App\controllers\UserController', 'create']);
            $r->addRoute('POST', '/user/store', ['App\controllers\UserController', 'store']);
            $r->addRoute('POST', '/user/delete', ['App\controllers\UserController', 'delete']);

            // The /{title} suffix is optional
            $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
        }

    }


    $r->addRoute('GET', '/signin', ['App\controllers\AuthController','signin']);
    $r->addRoute('GET', '/signup', ['App\controllers\AuthController','signup']);
    $r->addRoute('POST', '/login', ['App\controllers\AuthController','login']);
    $r->addRoute('GET', '/logout', ['App\controllers\AuthController','logout']);
    $r->addRoute('POST', '/register', ['App\controllers\AuthController','register']);


});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        if (!$auth->isLoggedIn()){
            flash()->error('Доступ запрещён');
            \App\Helper::redirect('signin', 400);

        }
        flash()->error('Доступ запрещён');
        \App\Helper::redirect('');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'Page not found code: 405';
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $handlerMethod = $handler[1];
        $classController = $handler[0];
        $var = $routeInfo[2];
        //Авто создание инстанса класса контроллера и вызов его метода
        $container->call([$classController, $handlerMethod]);
        break;
}