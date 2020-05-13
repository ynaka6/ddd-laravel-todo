<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Task\MyTasksRequest;
use Illuminate\View\View;
use Package\Task\Application\UseCase\GetUserTasksUseCase;

class MyListController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(MyTasksRequest $request, GetUserTasksUseCase $usecase): View
    {
        $outputData = $usecase->handle($request->inputData());

        // TODO: Presenterなり修正が必要
        return view('home', [
            'taskList' => $outputData->taskList(),
            'selectedTaskList' => $outputData->selectedTaskList(),
            'tasks' => $outputData->tasks(),
        ]);
    }
}
