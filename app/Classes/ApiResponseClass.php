<?php

namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
class ApiResponseClass
{
    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        $errorMessage = $message . ' Exception: ' . $e->getMessage();
        self::throw($e, $errorMessage);
    }
    

    public static function throw($e, $message = "Something went wrong! Process not completed")
    {
        Log::info($e);
        $errorMessage = $message . ' Exception: ' . $e->getMessage();
        throw new HttpResponseException(response()->json(["message" => $errorMessage], 500));
    }

    public static function sendResponse($data, $message = '', $code = 200)
{
    $response = [
        'success' => true,
        'data'    => $data,
    ];

    if (!empty($message)) {
        $response['message'] = $message;
    }

    return response()->json($response, $code);
}

}