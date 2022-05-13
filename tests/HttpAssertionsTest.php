<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Restolia\Kernel;
use Restolia\Testing\Http\HttpAssertions;

class HttpAssertionsTest extends TestCase
{
    use HttpAssertions;

    protected Kernel $kernel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->kernel = Kernel::boot(TestApplication::class);
    }

    public function testGet(): void
    {
        $this->get('/', ['param' => 1])
            ->assertOk()
            ->assertContent('simple handler: 1');
    }

    /**
     * @dataProvider headerCases
     * @param string $method
     * @return void
     */
    public function testWithHeader(string $method): void
    {
        $this->{$method}('/header', headers: ['X-Foo' => 'foo'])
            ->assertOk()
            ->assertHasHeader('Content-Type', 'application/json');
    }

    public function headerCases(): array
    {
        return [
            'get' => [
                'method' => 'get'
            ],
            'post' => [
                'method' => 'post'
            ],
            'put' => [
                'method' => 'put'
            ],
            'delete' => [
                'method' => 'delete'
            ],
            'patch' => [
                'method' => 'patch'
            ]
        ];
    }

    public function testHasHeaderWithoutValue(): void
    {
        $this->post('/user')
            ->assertOk()
            ->assertHasHeader('Content-Type');
    }

    public function testHasHeaderWithValue(): void
    {
        $this->post('/user')
            ->assertOk()
            ->assertHasHeader('Content-Type', 'application/json');
    }

    public function testPost(): void
    {
        $this->post('/user', content: json_encode(['first_name' => 'John']))
            ->assertOk()
            ->assertJson([
                'first_name' => 'John'
            ]);
    }

    public function testPut(): void
    {
        $this->put('/user', content: json_encode(['first_name' => 'John']))
            ->assertOk()
            ->assertJson([
                'first_name' => 'John'
            ]);
    }

    public function testDelete(): void
    {
        $this->delete('/user', ['id' => 1])
            ->assertOk()
            ->assertJson(['ok' => true]);

        $this->delete('/user', ['id' => 0])
            ->assertOk()
            ->assertJson(['ok' => false]);
    }

    public function testPatch(): void
    {
        $this->patch('/user', content: json_encode(['first_name' => 'John']))
            ->assertOk()
            ->assertJson([
                'first_name' => 'John'
            ]);
    }
}