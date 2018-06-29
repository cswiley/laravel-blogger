<?php

namespace Cswiley\Blogger\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Cswiley\Blogger\Models\Blog;
use Cswiley\Blogger\Resources\BlogResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function json_encode;
use function str_replace;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $user;

    public function __construct(Request $request)
    {
        $this->middleware('web');
        $this->middleware(['auth'], [
            'except' => ['show']
        ]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->setMenu($request, $this->user);

            return $next($request);
        })->except('show');
    }

    private function setMenu($request, $user)
    {
        // @todo menu urls
        $menu = config('blogger.menu');

        $menu = array_filter($menu, function ($menu) use ($user) {
            if ($user->hasRole('admin')) {
                return true;
            }

            return empty($menu['role']) || $menu['role'] === 'manager';

        });

        $url     = $request->segment(1);
        $pattern = !empty($url) ? "/$url/" : false;
        $menu    = array_map(function ($n) use ($pattern) {
            $n['active'] = false;
            if ($pattern !== false && preg_match($pattern, $n['url'])) {
                $n['active'] = true;
            }

            return $n;
        }, $menu);

        view()->share('userAccount', $user->toArray());
        view()->share('menu', $menu);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blogger::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogger::create', [
            'options' => json_encode([
                'visibility_options' => Blog::$visibilityLookup
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog               = new Blog;
        $publishedAt        = new Carbon(str_replace('@', '', $request->input('published_at')));
        $blog->content      = $request->input('content');
        $blog->user_id      = Auth::id() ?? 0;
        $blog->visibility   = $request->input('visibility', BLOG::VISIBILITY_PRIVATE);
        $blog->published_at = $publishedAt;
        $blog->image        = $request->input('image');
        $blog->title        = $request->input('title');
        $blog->slug         = $blog->title;
        $blog->save();

        return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  String|Id $blogIdOrName
     * @return \Illuminate\Http\Response
     */
    public function show($blogIdorName)
    {
        $blog = Blog::where('id', $blogIdorName)->first();
        if (empty($blog)) {
            $blog = Blog::where('slug', $blogIdorName)->first();
        }
        if (empty($blog)) {
            abort(404, 'Blog not found');
        }

        if (!$blog->is_active && !Auth::id()) {
            abort(404, 'Blog not found');
        }

        return view('blogger::show', [
            'blog' => $blog->toArray()
        ]);
    }

    public function preview(Request $request, $id)
    {
        $input = $request->all();
        if ($id !== $input['id']) {
            abort(404, 'blog not found');
        }

        return view('blogger::show', [
            'blog'      => $input,
            'isPreview' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cswiley\Blogger\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogger::edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cswiley\Blogger\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if (!empty($blog)) {
            $publishedAt        = new Carbon(str_replace('@', '', $request->input('published_at')));
            $blog->content      = $request->input('content');
            $blog->visibility   = $request->input('visibility', BLOG::VISIBILITY_PRIVATE);
            $blog->published_at = $publishedAt;
            $blog->title        = $request->input('title');
            $blog->slug         = $blog->title;
            $blog->image        = $request->input('image');
            $blog->save();

            return new BlogResource($blog);
        }
    }
}
