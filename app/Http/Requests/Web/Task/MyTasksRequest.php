<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Task;

use Illuminate\Http\Request;
use Package\Task\Application\InputData\GetUserTasksInputData;

class MyTasksRequest
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function inputData(): GetUserTasksInputData
    {
        return new GetUserTasksInputData(optional($this->request->user())->id);
    }
}
