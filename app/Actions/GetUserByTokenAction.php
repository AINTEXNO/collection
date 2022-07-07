<?php


namespace App\Actions;


use App\Models\User;

class GetUserByTokenAction
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function __invoke($token)
    {
        return $this->model->where('api_token', $token)->first();
    }
}
