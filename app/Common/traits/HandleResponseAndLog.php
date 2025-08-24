<?php

namespace App\Common\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait HandleResponseAndLog
{
    protected function logError(Throwable $e, string $context = ''): void
    {
        Log::error("[$context] " . $e->getMessage(), [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }

    protected function successResponse(mixed $data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(string $message = 'Something went wrong', int $code = 500, ?Throwable $e = null, string $context = '')
    {
        if ($e) {
            $this->logError($e, $context);

            if (app()->environment('local', 'development')) {
                $message = $e->getMessage();
            }
        }

        return response()->json([
            'success' => false,
            'error' => $message,
        ], $code);
    }
}
