<?php

if (!function_exists('successResponse')) {
    function successResponse($data = [], $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse($message = 'Failed', $statusCode = 400, $errors = [])
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
