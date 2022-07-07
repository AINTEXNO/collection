<?php


namespace App\Actions;


use App\Models\User;
use Illuminate\Http\Request;

class RegistrationUserAction
{
    public function __invoke(array $data)
    {
        return User::create($data);
    }
}
