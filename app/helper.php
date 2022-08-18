<?php

function response_error(string $error, $status = 400)
{
    return response()->json([
        'error' => $error,
    ], $status);
}


function response_success(array $data, $status = 200)
{
    return response()->json($data, $status);
}
