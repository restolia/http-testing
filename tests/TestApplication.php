<?php

namespace Tests;

use FastRoute\RouteCollector;
use Restolia\Foundation\Application;
use Restolia\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class TestApplication extends Application
{
    public function routes(RouteCollector $router): void
    {
        $router->get('/', [self::class, 'handle']);
        $router->post('/user', [self::class, 'create']);
        $router->put('/user', [self::class, 'createOrUpdate']);
        $router->delete('/user', [self::class, 'delete']);
        $router->patch('/user', [self::class, 'createOrUpdate']);

        $router->get('/header', [self::class, 'header']);
        $router->post('/header', [self::class, 'header']);
        $router->put('/header', [self::class, 'header']);
        $router->delete('/header', [self::class, 'header']);
        $router->patch('/header', [self::class, 'header']);
    }

    public function handle(Request $request, Response $response): void
    {
        $response->setContent('simple handler: ' . $request->get('param'));

        $response->send();
    }

    public function header(Request $request, Response $response): void
    {
        if($request->headers->get('X-Foo', false) !== 'foo') {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->send();
    }

    public function create(Request $request, Response $response): void
    {
        $response->json($request->getContent())->send();
    }

    public function createOrUpdate(Request $request, Response $response): void
    {
        $response->json($request->getContent())->send();
    }

    public function delete(Request $request,Response $response): void
    {
        $response->json([
            'ok' => $request->get('id') == 1
        ])->send();
    }
}
