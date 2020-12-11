<?php

namespace Modules\Blog\Http\Controllers\Web;

use Modules\Blog\Transformers\Web\BlogResource;
use Modules\Blog\Transformers\Web\BlogListResource;
use Modules\Blog\Services\BlogService;
use Modules\Blog\Entities\Blog;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(BlogService $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return BlogListResource::collection($this->blog->getPublishedBlogs());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

}
