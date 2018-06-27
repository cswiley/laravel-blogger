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

    protected function storageDisk()
    {
        return Storage::disk(config('blogger.storage_disk'));
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
            $path = $request->file->store(config('blogger.storage_directory'), config('blogger.storage_disk'));

            return JsonResponse::jsonOk([
                'path' => $path,
                'url'  => $this->storageDisk()->url($path)
            ]);
        }

        return JsonResponse::jsonFail('Unable to store image');
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');
        if (!empty($path)) {
            if ($this->storageDisk()->exists($path)) {
                $res = $this->storageDisk()->delete($path);
                if ($res) {
                    return JsonResponse::jsonOk(['message' => 'Image removed']);
                }
            }
        }

        return JsonResponse::jsonFail('Unable to delete');

    }
}
