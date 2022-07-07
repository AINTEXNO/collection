<?php


namespace App\Actions;


use Illuminate\Http\Request;

class LogoutUserAction
{
    public function __invoke(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
