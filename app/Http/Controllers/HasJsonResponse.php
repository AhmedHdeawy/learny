<?php


namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;

trait HasJsonResponse
{

    // Return Structured API Json Response
    protected function jsonResponse($status, $message = [], $errors = null, $data = null) :JsonResponse
    {
        return response()->json([
            'status'        => $status,
            'message'       => $message,
            'errors'        => $errors,
            'data'          => $data
        ]);
    }
}
