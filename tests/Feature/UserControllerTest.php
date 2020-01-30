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
        factory(User::class, 2)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk()
            ->assertViewIs('users.index')
            ->assertViewHas('users');
    }

    /**
     * @test
     */
    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', $user));

        $response->assertOk()
            ->assertViewIs('users.show')
            ->assertViewHas('user');
    }
}
