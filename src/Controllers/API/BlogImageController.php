<?php

namespace \Cswiley\Blogger\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function response;

class BlogImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
            $path = $request->file->store('images', 'public');

//            $path = $request->file->store('images', 's3');
            return response()->json([
                'ok'   => true,
                'path' => '/storage/' . $path
            ]);
        }
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');
        if (! empty($path)) {
            $path = str_replace('/storage/', '', $path);
            if (Storage::disk('public')->exists($path)) {
                $res = Storage::disk('public')->delete($path);
                if ($res) {
                    return $this->jsonOk(['message' => 'Image removed']);
                }
            }
        }

        return $this->jsonFail('Unable to delete');

    }

    private function jsonOk($data)
    {
        return response()->json(array_merge([
            'ok' => true,
        ], $data));
    }

    private function jsonFail($message) {
        return response()->json([
            'ok' => false,
            'error' => $message
        ]);
    }
}
