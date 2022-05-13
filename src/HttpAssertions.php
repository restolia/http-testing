<?php

namespace Restolia\Testing\Http;

use Symfony\Component\HttpFoundation\Request;
use Restolia\Http\Response;

trait HttpAssertions
{
    public function get(string $path, array $parameters = [], array $headers = []): TestResponse
    {
        return $this->request(Request::METHOD_GET, $path, $parameters, headers: $headers);
    }

    public function post(string $path, array $parameters = [], ?string $content = null, array $headers = []): TestResponse
    {
        return $this->request(Request::METHOD_POST, $path, $parameters, $content, $headers);
    }

    public function put(string $path, array $parameters = [], ?string $content = null, array $headers = []): TestResponse
    {
        return $this->request(Request::METHOD_PUT, $path, $parameters, $content, $headers);
    }

    public function delete(string $path, array $parameters = [], ?string $content = null, array $headers = []): TestResponse
    {
        return $this->request(Request::METHOD_DELETE, $path, $parameters, $content, $headers);
    }

    public function patch(string $path, array $parameters = [], ?string $content = null, array $headers = []): TestResponse
    {
        return $this->request(Request::METHOD_PATCH, $path, $parameters, $content, $headers);
    }

    public function request(string $method, string $path, array $parameters = [], ?string $content = null, array $headers = []): TestResponse
    {
        $request = Request::create($path, $method, $parameters, content: $content);
        $request->headers->add($headers);

        $this->kernel::set(
            Request::class,
            $request,
        );

        $this->kernel::set(
            Response::class,
            $response = new TestResponse($this),
        );

        ob_start();
        $this->kernel->resolve();
        ob_end_clean();

        return $response;
    }
}