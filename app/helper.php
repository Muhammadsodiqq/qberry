<?php

function response_error($error, $status = 400)
{
    return response()->json([
        'error' => $error,
    ], $status);
}
