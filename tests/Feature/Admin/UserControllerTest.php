<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function testIndex()
    {
        $actingUser = factory(User::class)->create();

        factory(User::class, 2)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.users.index'));

        $response->assertOk()
            ->assertViewIs('admin.index')
            ->assertViewHas('users');
    }

    /** @test */
    public function testShow()
    {
        $actingUser = factory(User::class)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.users.show', $user));

        $response->assertOk()
            ->assertViewIs('admin.show')
            ->assertViewHas('user');
    }

    /** @test */
    public function testEdit()
    {
        $actingUser = factory(User::class)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.users.edit', $user));

        $response->assertOk()
            ->assertViewIs('admin.edit')
            ->assertViewHas('user');
    }

    /** @test */
    public function testUpdate()
    {
        $actingUser = factory(User::class)->create();

        $user = factory(User::class)->create();

        $url = route('admin.users.update', $user);

        $password = $this->faker->password();

        $formData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->actingAs($actingUser)
            ->patch($url, $formData);

        $response->assertRedirect(route('admin.users.show', $user));

        $response->assertSessionHas('status', __('statuses.users.updated'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $formData['name'],
            'email' => $formData['email']
        ]);
    }

    /** @test */
    public function testCreate()
    {
        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.users.create'));

        $response->assertOk()
            ->assertViewIs('admin.create');
    }

    /** @test */
    public function testStore()
    {
        $actingUser = factory(User::class)->create();

        $url = route('admin.users.store');

        $password = $this->faker->password();

        $formData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->actingAs($actingUser)
            ->post($url, $formData);

        $response->assertRedirect(route('admin.users.index'));

        $response->assertSessionHas('status', __('statuses.users.created'));

        $this->assertDatabaseHas('users', [
            'name' => $formData['name'],
            'email' => $formData['email']
        ]);
    }

    /** @test */
    public function testDestroy()
    {
        $actingUser = factory(User::class)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->delete(route('admin.users.destroy', $user));

        $response->assertRedirect(route('admin.users.index'));

        $response->assertSessionHas('status', __('statuses.users.destroyed'));

        $this->assertSoftDeleted('users', [
            'id' => $user->id
        ]);
    }
}
