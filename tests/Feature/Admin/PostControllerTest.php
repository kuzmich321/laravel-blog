<?php

namespace Tests\Feature\Admin;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @return void
     */
    public function testIndex()
    {
        $url = route('admin.posts.index');

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        factory(Post::class, 3)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.posts.index'));

        $response->assertOk()
            ->assertViewIs('admin.posts.index')
            ->assertViewHas('posts');
    }

    /**
     * @return void
     */
    public function testShow()
    {
        $createdPost = factory(Post::class)->create();

        $url = route('admin.posts.show', $createdPost);

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.posts.show')
            ->assertViewHas('post');
    }

    /**
     * @return void
     */
    public function testEdit()
    {
        $createdPost = factory(Post::class)->create();

        $url = route('admin.posts.edit', $createdPost);

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.posts.edit')
            ->assertViewHas('post');
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $createdPost = factory(Post::class)->create();

        $formData = [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph()
        ];

        $url = route('admin.posts.update', $createdPost);

        $response = $this->patch($url, $formData);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->patch($url, $formData);

        $response->assertRedirect(route('admin.posts.show', $createdPost));

        $response->assertSessionHas('status', __('statuses.posts.updated'));

        $this->assertDatabaseHas($createdPost->getTable(), $formData);
    }

    /**
     * @return void
     */
    public function testCreate()
    {
        $url = route('admin.posts.create');

        $response = $this->get($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->get($url);

        $response->assertOk()
            ->assertViewIs('admin.posts.create');
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $url = route('admin.posts.store');

        $actingUser = factory(User::class)->create();

        $formData = [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'user_id' => $actingUser->id
        ];

        $response = $this->post($url, $formData);

        $response->assertRedirect(route('login'));

        $response = $this->actingAs($actingUser)
            ->post($url, $formData);

        $response->assertRedirect(route('admin.posts.index'));

        $response->assertSessionHas('status', __('statuses.posts.created'));

        $this->assertDatabaseHas('posts', $formData);
    }

    /**
     * @return void
     */
    public function testDestroy()
    {
        $createdPost = factory(Post::class)->create();

        $url = route('admin.posts.destroy', $createdPost);

        $response = $this->delete($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->delete($url);

        $response->assertRedirect(route('admin.posts.index'));

        $response->assertSessionHas('status', __('statuses.posts.destroyed'));

        $this->assertSoftDeleted($createdPost->getTable(), [
            'id' => $createdPost->id
        ]);
    }

    /**
     * @return void
     */
    public function testRestore()
    {
        $createdPost = factory(Post::class)->create([
            'deleted_at' => now()
        ]);

        $url = route('admin.posts.restore', $createdPost);

        $response = $this->patch($url);

        $response->assertRedirect(route('login'));

        $actingUser = factory(User::class)->create();

        $response = $this->actingAs($actingUser)
            ->patch($url);

        $response->assertRedirect(route('admin.posts.index'));

        $response->assertSessionHas('status', __('statuses.posts.restored'));

        $this->assertDatabaseHas($createdPost->getTable(), [
            'id' => $createdPost->id
        ]);
    }
}
