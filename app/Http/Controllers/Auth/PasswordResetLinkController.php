<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required', 'email']);

        SendPasswordResetEmail::dispatchIf(
            User::query()
                ->whereEmail($request->get('email'))
                ->exists(),
            $request->get('email')
        )->afterResponse();

        return back()->with('status', 'Password reset link sent!');
    }
}
