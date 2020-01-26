<?php

namespace Tests\Feature\Admin;

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
        $authUser = factory(User::class)->create();

        factory(User::class, 2)->create();

        $response = $this->actingAs($authUser)
            ->get(route('admin.users.index'));

        $response->assertOk()
            ->assertViewIs('admin.index')
            ->assertViewHas('users');
    }

    /**
     * @test
     */
    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('admin.users.show', $user));

        $response->assertOk()
            ->assertViewIs('admin.show')
            ->assertViewHas('user');
    }
}
