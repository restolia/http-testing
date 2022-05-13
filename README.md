# Restolia - Http Testing
The Http testing package for Restolia applications, this package makes it easier to write tests for your Http handlers.

# Getting Started

## Install via Composer
Install via Composer into an existing Restolia project.

```
composer require restolia/http-testing
```

## How to use
To use the package add the following trait **HttpAssertions** to your TestCase.php file included in your Restolia project, this file is located at **tests/TestCase.php**.

Example:

```php
<?php

namespace Tests;

use App\App;
use Restolia\Kernel;
use Restolia\Testing\Http\HttpAssertions;

class TestCase extends \PHPUnit\Framework\TestCase
{
    use HttpAssertions;

    ...
}
```

# Example
Imagine we have a simple handler called **StatusHandler** and the handler is executed when we hit the "/" endpoint of our application. We would like to assert that the response Http Status Code is 200 OK. 

To test this we can write:

```php
<?php

namespace Tests\Application\Handlers;

use Tests\TestCase;

class StatusHandlerTest extends TestCase
{
    public function testHandleDoesReturnOk(): void
    {
        $this->get('/')->assertOk();
    }
}
```