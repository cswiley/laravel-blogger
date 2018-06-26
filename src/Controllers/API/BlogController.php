<?php namespace Cswiley\Blogging\Controllers\API;

use Cswiley\Blogging\Models\Blog;
use Cswiley\Blogging\Resources\BlogCollection;
use Cswiley\Blogging\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
