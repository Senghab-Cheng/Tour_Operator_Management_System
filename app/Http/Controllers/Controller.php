<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class Controller
{
    use AuthorizesRequests;

    protected function respond(Request $request, mixed $data, int $status = 200, ?string $redirect = null, ?string $message = null): JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($data, $status);
        }

        $response = $redirect !== null ? redirect($redirect) : back();

        if ($message !== null) {
            $response = $response->with('success', $message);
        }

        return $response;
    }
}
