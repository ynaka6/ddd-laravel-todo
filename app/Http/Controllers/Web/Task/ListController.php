<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Task\MyTasksRequest;
use App\Http\ViewModels\Web\ListFormViewModel;
use Illuminate\View\View;
use Package\Task\Application\UseCase\GetUserTasksUseCase;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new(): View
    {
        $viewModel = new ListFormViewModel('Create New List', 'Input title of List');
        return view('list.form', compact('viewModel'));
    }

    public function edit($listId): View
    {
        $viewModel = new ListFormViewModel('Change List Name', 'Input title of List');
        return view('list.form', compact('viewModel'));
    }
}
