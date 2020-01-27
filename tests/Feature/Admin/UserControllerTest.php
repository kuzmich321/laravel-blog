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
        $url = route('admin.users.index');

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        factory(User::class, 2)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.index')
            ->assertViewHas('users');
    }

    /** @test */
    public function testShow()
    {
        $createdUser = factory(User::class)->create();

        $url = route('admin.users.show', $createdUser);

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.show')
            ->assertViewHas('user');
    }

    /** @test */
    public function testEdit()
    {
        $createdUser = factory(User::class)->create();

        $url = route('admin.users.edit', $createdUser);

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.edit')
            ->assertViewHas('user');
    }

    /** @test */
    public function testUpdate()
    {
        $createdUser = factory(User::class)->create();

        $url = route('admin.users.update', $createdUser);

        $password = $this->faker->password();

        $formData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->patch($url, $formData);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->patch($url, $formData);

        $response->assertRedirect(route('admin.users.show', $createdUser));

        $response->assertSessionHas('status', __('statuses.users.updated'));

        $this->assertDatabaseHas('users', [
            'id' => $createdUser->id,
            'name' => $formData['name'],
            'email' => $formData['email']
        ]);
    }

    /** @test */
    public function testCreate()
    {
        $url = route('admin.users.create');

        $response = $this->get($url);

        $response->assertRedirect('login');

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.users.create'));

        $response->assertOk()
            ->assertViewIs('admin.create');
    }

    /** @test */
    public function testStore()
    {
        $url = route('admin.users.store');

        $password = $this->faker->password();

        $formData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->post($url, $formData);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

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
        $createdUser = factory(User::class)->create();

        $url = route('admin.users.destroy', $createdUser);

        $response = $this->delete($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->delete($url);

        $response->assertRedirect(route('admin.users.index'));

        $response->assertSessionHas('status', __('statuses.users.destroyed'));

        $this->assertSoftDeleted('users', [
            'id' => $createdUser->id
        ]);
    }

    /** @test */
    public function testRestore()
    {
        $createdUser = factory(User::class)->create([
            'deleted_at' => now()
        ]);

        $url = route('admin.users.restore', $createdUser);

        $response = $this->patch($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->patch($url);

        $response->assertRedirect(route('admin.users.index'));

        $response->assertSessionHas('status', __('statuses.users.restored'));

        $this->assertDatabaseHas('users', [
            'id' => $createdUser->id
        ]);
    }
}
