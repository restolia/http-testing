<?php

namespace Restolia\Testing\Http;

use PHPUnit\Framework\TestCase;
use Restolia\Http\Response;

class TestResponse extends Response
{
    private TestCase $testCase;

    public function __construct(TestCase $testCase, ?string $content = '', int $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);

        $this->testCase = $testCase;
    }

    public function assertOk(): self
    {
        $this->testCase::assertEquals(self::HTTP_OK, self::getStatusCode());

        return $this;
    }

    public function assertCreated(): self
    {
        $this->testCase::assertEquals(self::HTTP_CREATED, self::getStatusCode());

        return $this;
    }

    public function assertAccepted(): self
    {
        $this->testCase::assertEquals(self::HTTP_ACCEPTED, self::getStatusCode());

        return $this;
    }

    public function assertNoContent(): self
    {
        $this->testCase::assertEquals(self::HTTP_NO_CONTENT, self::getStatusCode());

        return $this;
    }

    public function assertBadRequest(): self
    {
        $this->testCase::assertEquals(self::HTTP_BAD_REQUEST, self::getStatusCode());

        return $this;
    }

    public function assertUnauthorized(): self
    {
        $this->testCase::assertEquals(self::HTTP_UNAUTHORIZED, self::getStatusCode());

        return $this;
    }

    public function assertNotFound(): self
    {
        $this->testCase::assertEquals(self::HTTP_NOT_FOUND, self::getStatusCode());

        return $this;
    }

    public function assertHasHeader(string $name, ?string $value = null): self
    {
        $this->testCase::assertTrue($this->headers->has($name));

        if ($value) {
            $this->testCase::assertEquals($value, $this->headers->get($name));
        }

        return $this;
    }

    public function assertContent(string $expected): self
    {
        $this->testCase::assertEquals($expected, self::getContent());

        return $this;
    }

    public function assertJson(array $expected): self
    {
        $this->testCase::assertJsonStringEqualsJsonString(
            json_encode($expected),
            self::getContent(),
        );

        return $this;
    }
}