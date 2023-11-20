<?php

namespace App\Http\Controllers\Auth\Github;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function __invoke()
    {
        return Socialite::driver('github')->redirect();
    }
}
