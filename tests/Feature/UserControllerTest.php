<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testIndex()
    {
        $users = factory(User::class, 2)->states('with_posts')->create();

        $response = $this->get(route('users.index'));

        $receivedData = $response->getOriginalContent()->getData($users);

        $response->assertStatus(200)->assertViewIs('index')->assertViewHasAll($receivedData);
    }

    /**
     * @test
     */
    public function testShow()
    {
        $user = factory(User::class)->states('with_posts')->create();

        $response = $this->get(route('users.show', $user));

        $receivedData = $response->getOriginalContent()->getData($user);

        $response->assertStatus(200)->assertViewIs('show')->assertViewHasAll($receivedData);
    }
}
