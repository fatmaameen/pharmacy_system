<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponseTrait
{
    public static function apiResponse($data = [], $message , $status = 200)
    {
        return response()
        ->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ],$status);
    }

    public static function failedValidation($validator,$data = [], $message = '',$status)
    {
        $errors = $validator->errors()->toArray();
        $response = [
            'data' => $data,
            'message' => $message,
            'errors' => $errors,
            'status' => $status
        ];
        throw new HttpResponseException(response()->json($response, $status));
    }
}



?>
