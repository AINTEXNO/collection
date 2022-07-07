<?php

namespace App\Http\Controllers;

use App\Actions\LogoutUserAction;
use App\Actions\RegistrationUserAction;
use App\Actions\StoreUploadFileAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->validated())) {
            if(auth()->user()->blocked) return redirect()->route('user.blocked');
            $request->session()->regenerate();
        }

        return auth()->user()
            ? $this->index()
            : back()->withErrors(['email' => ' ', 'password' => 'Неверный логин или пароль'])->withInput();
    }

    /**
     * @param RegistrationRequest $request
     * @param RegistrationUserAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(RegistrationRequest $request, RegistrationUserAction $action): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $validated['api_token'] = Str::random(80);
        $action($validated);
        return back()->with(['registration' => true]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param int $id
     * @param \App\Actions\StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, int $id, StoreUploadFileAction $action): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($id);

        if($file = $request->file('image'))
            $request->merge(['photo' => $action($file)]);

        $user->update($request->all());

        return back()->with(['updated' => "Данные пользователя \"{$user->full_name}\" успешно изменены"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout(Request $request, LogoutUserAction $action): \Illuminate\Http\RedirectResponse
    {
        $action($request);
        return redirect()->route('home');
    }

    public function authentication(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password))
            return response()->json(['status' => true, 'token' => $user->api_token]);

        return response()->json(['status' => false])->setStatusCode(400);
    }

    public function users()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function updateUserStatus(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user->update(['blocked' => $request->status]);
        return $request->status ? back()->with(['blocked' => "Пользователь {$user->full_name} заблокирован"])
            : back()->with(['unlocked' => "Пользователь {$user->full_name} разблокирован"]);
    }

    public function updateUserRole(Request $request, User $user)
    {
        $user->update(['role_id' => $request->role_id]);
        return back()->with(['updated' => "Должность пользователя {$user->full_name} изменена"]);
    }

    public function blocked()
    {
        auth()->logout();

        return view('user.blocked');
    }

    public function reset(ResetPasswordRequest $request, User $user)
    {
        if(Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => $request->input('new_password')]);
            return back()->with(['reset' => 'Пароль от учетной записи успешно изменен']);
        }

        return back()->withErrors(['old_password' => 'Неверный старый пароль'])->withInput();
    }
}
