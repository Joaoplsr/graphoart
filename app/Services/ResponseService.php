<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class ResponseService {
    public static function success($message, $code = Response::HTTP_OK, $data = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function loginSuccess($message, $code = Response::HTTP_OK, $token, $role, $name)
    {
        return response()->json([
            'message' => $message,
            'token' => $token,
            'role' => $role,
            'name' => $name
        ], $code);
    }

    public static function error($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'message' => $message
        ], $code);
    }
}