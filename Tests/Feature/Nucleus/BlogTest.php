<?php

namespace Modules\Blog\Tests\Feature\Nucleus;

use Modules\Blog\Tests\TestCase;
use Modules\Blog\Entities\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actAsAdminUser();
        $this->withoutExceptionHandling();
    }

    public function test_we_can_list_blogs()
    {
        $blogs = Blog::factory()->times(50)->create();

        $response = $this->json('GET', 'api/blogs', [
            "search" => "",
            "order" => "id",
            "sort" => "ASC",
            "paginate" => 25,
        ]);

        $response->assertStatus(200);
    }

    public function test_we_can_get_a_single_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->get("api/blogs/$blog->id");

        $response->assertStatus(200);

    }

    public function test_we_can_create_a_new_blog()
    {
        $blog = Blog::factory()->make()->toArray();

        $response = $this->post('api/blogs', $blog);

        $response->assertStatus(201);
    }

    public function test_we_can_edit_a_blog()
    {
        $blog = Blog::factory()->create();

        $data = [
            'title' => 'New Title',
            'content' => 'New Content',
        ];

        $response = $this->put("api/blogs/$blog->id", $data);

        $response->assertStatus(201);

        $blog->refresh();

        $this->assertEquals($data['title'], $blog->title);
        $this->assertEquals($data['content'], $blog->content);

    }

    public function test_we_can_delete_a_blog_post()
    {
        $blog = Blog::factory()->create();

        $data = [
            'id' => [
                $blog->id,
            ],
        ];

        $response = $this->delete('api/blogs', $data);

        $response->assertStatus(201);

        $this->assertDatabaseCount('blogs', 0);

    }

    public function test_we_can_publish_a_blog()
    {
        $blog = Blog::factory()->create([
            'published' => false,
        ]);

        $data = [
            'title' => $blog->title,
            'content' => $blog->content,
            'published' => true,
        ];

        $response = $this->put("api/blogs/$blog->id", $data);

        $response->assertStatus(201);

        $blog->refresh();

        $this->assertEquals(true, $blog->published);

    }

    public function test_we_can_unpublish_a_blog()
    {
        $blog = Blog::factory()->create([
            'published' => true,
        ]);

        $data = [
            'title' => $blog->title,
            'content' => $blog->content,
            'published' => false,
        ];

        $response = $this->put("api/blogs/$blog->id", $data);

        $response->assertStatus(201);

        $blog->refresh();

        $this->assertEquals(false, $blog->published);

    }
}
