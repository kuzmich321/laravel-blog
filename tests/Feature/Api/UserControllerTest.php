<?php

namespace Tests\Feature\Api;

use App\User;
use App\Http\Resources\UserCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $url = route('api.users.index');

        factory(User::class, 5)->create();

        $paginatedUsers = (new UserCollection(User::paginate()))->resolve();

        $response = $this->get($url);

        $response->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson([
                'data' => $paginatedUsers
            ]);
    }

    /**
     *
     * @return void
     */
    public function testShow()
    {
        $createdUser = factory(User::class)->create();

        $url = route('api.users.show', $createdUser);

        $response = $this->get($url);

        $response->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['data' => $createdUser->toArray()]);
    }
}
