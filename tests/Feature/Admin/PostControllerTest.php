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

    /** @test */
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

    /** @test */
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

    /** @test */
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

    /** @test */
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

        $this->assertDatabaseHas('posts', $formData);
    }
}
