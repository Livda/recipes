<?php

namespace App\Tests\Large;

class LoginTest extends LargeTest
{
    public function testLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }

    public function testLogout(): void
    {
        $client = $this->loginUser();

        $client->request('GET', '/logout');

        $this->assertResponseRedirects(
            expectedLocation: 'http://localhost/',
        );
    }
}
