<?php

namespace Cswiley\Blogger\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cswiley\Blogger\JsonResponse;

class BlogImageController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'web',
            'auth'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->store(config('blogger.storage_disk'));

            return JsonResponse::jsonOk([
                'path' => $path,
                'url'  => Storage::url($path)
            ]);
        }

        return JsonResponse::jsonFail('Unable to store image');
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');
        if (!empty($path)) {
            if (Storage::exists($path)) {
                $res = Storage::delete($path);
                if ($res) {
                    return JsonResponse::jsonOk(['message' => 'Image removed']);
                }
            }
        }

        return JsonResponse::jsonFail('Unable to delete');

    }
}
