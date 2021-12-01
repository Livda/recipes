<?php

namespace App\Tests\Large\Recipe;

use App\Tests\Large\LargeTest;

class ListRecipesTest extends LargeTest
{
    public function testRedirectToLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/recipes/');

        $this->assertResponseRedirects(
            expectedLocation: 'http://localhost/login',
        );
    }

    public function testListPage(): void
    {
        $client = $this->loginAdmin();
        $client->request('GET', '/recipes/');

        $this->assertResponseIsSuccessful();
    }
}
