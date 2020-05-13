<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Task\PostRequest;
use Illuminate\Http\RedirectResponse;
use Package\Task\Application\UseCase\CreateTaskUseCase;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(PostRequest $request, CreateTaskUseCase $usecase): RedirectResponse
    {
        $usecase->handle($request->inputData());
        return redirect()->route('home');
    }
}
