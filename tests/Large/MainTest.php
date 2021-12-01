<?php

namespace App\Tests\Large;

class MainTest extends LargeTest
{
    public function testHomepage(): void
    {
        $client = $this->loginUser();

        $client->request('GET', '/');

        $this->assertResponseRedirects(
            expectedLocation: '/recipes/',
        );
    }
}
