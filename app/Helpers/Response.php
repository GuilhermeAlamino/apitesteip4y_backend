<?php

namespace App\Helpers;

class Response
{
  public static function Api($success, $message, $statusCode = 200, $data = null)
  {
    $response = [
      'success' => $success,
      'message' => $message,
    ];

    if (!is_null($data)) {
      $response['data'] = $data;
    }

    return response()->json($response, $statusCode);
  }
}
