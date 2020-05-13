<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\LoginRequest;
use Illuminate\Validation\ValidationException;
use Package\User\Application\UseCase\LoginUserUseCase;
use Package\User\Application\UseCase\LogoutUserUseCase;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param App\Http\Requests\Web\User\LoginRequest           $request
     * @param Package\User\Application\UseCase\LoginUserUseCase $usecase
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request, LoginUserUseCase $usecase)
    {
        $inputData = $request->inputData();
        $outputData = $usecase->handle($inputData);

        if ($outputData->isSuccessful()) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Package\Auth\Application\UseCase\LogoutUserUseCase $usecase
     * @return \Illuminate\Http\Response
     */
    public function logout(LogoutUserUseCase $usecase)
    {
        $usecase->handle();
        return redirect()->route('login');
    }
}
