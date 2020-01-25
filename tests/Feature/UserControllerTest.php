<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function IndexMethod_Returns_AllUsers()
    {
        $users = factory(User::class, 2)->create();

        $response = $this->get(route('users.index', [
            'users' => $users
        ]));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ShowMethod_Returns_SingleUser()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', [
            'user' => $user
        ]));

        $response->assertStatus(200);
    }
}
