<?php

declare(strict_types=1);

namespace Package\Task\Application\OutputData;

use Package\Task\Application\OutputData\TaskList;

class GetListOutputData
{
    private $taskList;

    private $tasks;

    public function __construct(array $taskList, array $tasks)
    {
        $this->taskList = $taskList;
        $this->tasks = $tasks;
    }

    public function taskList(): array
    {
        return $this->taskList;
    }

    public function tasks(): array
    {
        return $this->tasks;
    }

    public function selectedTaskList(): TaskList
    {
        return array_filter($this->taskList, function($list) {
            return $list->isSelected();
        })[0];
    }
}
