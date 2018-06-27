<?php

namespace Cswiley\Blogger;

class JsonResponse
{
    public static function jsonOk($data)
    {
        return response()->json(array_merge([
            'ok' => true,
        ], $data));
    }

    public static function jsonFail($message)
    {
        return response()->json([
            'ok'    => false,
            'error' => $message
        ]);
    }
}