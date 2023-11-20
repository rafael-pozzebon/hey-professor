<?php

namespace App\Http\Controllers\Auth\Github;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Str;

class CallBackController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::query()
            ->updateOrCreate(
                ['nickname' => $githubUser->getNickname(), 'email' => $githubUser->getEmail()],
                ['name' => $githubUser->getName(), 'password' => Str::random(40), 'email_verified_at' => now()]
            );

        Auth::login($user);

        return to_route('dashboard');
    }
}
