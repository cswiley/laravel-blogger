<?php namespace Cswiley\Blogger\Controllers\API;

use Cswiley\Blogger\Models\Blog;
use Cswiley\Blogger\Resources\BlogCollection;
use Cswiley\Blogger\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
        $this->middleware(['auth'], [
            'except' => ['show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return new BlogCollection($blogs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        if (! empty($blog)) {
            return new BlogResource($blog);
        }
    }

    protected function jsonOk($data)
    {
        return response()->json(array_merge([
            'ok' => true,
        ], $data));
    }

    protected function jsonFail($message)
    {
        return response()->json([
            'ok'    => false,
            'error' => $message
        ]);
    }
}
