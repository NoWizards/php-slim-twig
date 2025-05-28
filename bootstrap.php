<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

// Set up PHP-DI Container
$container = new Container();

// Register Twig manually
$container->set(Twig::class, function () {
    $loader = new FilesystemLoader(__DIR__ . '/templates'); // path to your Twig templates
    return new Twig($loader, [
        'cache' => false, // disable cache for development
    ]);
});
// 🔥 Add this line
$container->set('view', fn($c) => $c->get(Slim\Views\Twig::class));

AppFactory::setContainer($container);
$app = AppFactory::create();

// Add Twig middleware
$app->add(TwigMiddleware::createFromContainer($app));

// Register routes
$app->get('/', [\App\Controller\HomeController::class, 'index']);

$app->get('/albums', [\App\Controller\AlbumsController::class, 'index']);

return $app;