<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Restolia\Testing\Http\TestResponse;

class ResponseTest extends TestCase
{
    public function testAssertOk(): void
    {
        (new TestResponse($this))->assertOk();
    }

    public function testAssertCreated(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_CREATED))->assertCreated();
    }

    public function testAssertAccepted(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_ACCEPTED))->assertAccepted();
    }

    public function testAssertNoContent(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_NO_CONTENT))->assertNoContent();
    }

    public function testAssertBadRequest(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_BAD_REQUEST))->assertBadRequest();
    }

    public function testAssertUnauthorized(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_UNAUTHORIZED))->assertUnauthorized();
    }

    public function testAssertNotFound(): void
    {
        (new TestResponse($this, status: TestResponse::HTTP_NOT_FOUND))->assertNotFound();
    }
}