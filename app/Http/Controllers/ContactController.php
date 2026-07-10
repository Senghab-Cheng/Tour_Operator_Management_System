<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $message = ContactMessage::create($validated);

        return $this->respond($request, $message, 201, route('contact'), 'Message sent successfully.');
    }

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', ContactMessage::class);

        return response()->json(
            ContactMessage::query()->latest()->paginate(20)
        );
    }
}
