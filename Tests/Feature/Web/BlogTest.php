<?php

namespace Modules\Blog\Tests\Feature\Web;

use Modules\Blog\Tests\TestCase;
use Modules\Blog\Entities\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function test_we_can_list_blogs()
    {
        $blogs = Blog::factory()->times(10)->create();

        $response = $this->get('blogs');

        $response->assertStatus(200);
    }

    public function test_we_can_get_a_single_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->get("blogs/$blog->slug");

        $response->assertStatus(200);

    }
}
