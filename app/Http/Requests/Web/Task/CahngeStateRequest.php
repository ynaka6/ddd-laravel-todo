<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Task;

use Illuminate\Http\Request;
use Package\Task\Application\InputData\ChangeStateInputData;

class CahngeStateRequest
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function inputData(): ChangeStateInputData
    {
        return new ChangeStateInputData(
            (int) $this->request->route('taskId'),
            optional($this->request->user())->id,
            (int) $this->request->route('listId'),
            $this->request->route('state')
        );
    }
}
