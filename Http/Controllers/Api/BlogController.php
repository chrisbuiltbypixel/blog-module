<?php

namespace Modules\Blog\Http\Controllers\Api;

use Modules\Blog\Transformers\Api\BlogResource;
use Modules\Blog\Transformers\Api\BlogListResource;
use Modules\Blog\Services\BlogService;
use Modules\Blog\Http\Requests\UpdateBlog;
use Modules\Blog\Http\Requests\StoreBlog;
use Modules\Blog\Entities\Blog;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
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
        return BlogListResource::collection($this->blog->all());
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreBlog $request)
    {
        return $this->blog->store($request->validated());
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBlog $request, Blog $blog)
    {
        $this->blog->update($blog->id, $request->validated());

        return $blog;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        return $this->blog->deleteMultiple($request->id);
    }
}
