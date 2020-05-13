<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Package\User\Application\UseCase\RegisterUserUseCase;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param App\Http\Requests\Web\User\RegisterRequest           $request
     * @param Package\User\Application\UseCase\RegisterUserUseCase $usecase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request, RegisterUserUseCase $usecase): RedirectResponse
    {
        $usecase->handle($request->inputData());
        // event(new Registered($authUser));
        return redirect()->route('home');
    }
}
