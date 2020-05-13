<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Task;

use Illuminate\Foundation\Http\FormRequest;
use Package\Task\Application\InputData\CreateTaskInputData;

class PostRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'listId' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:120'],
            'detail' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function inputData(): CreateTaskInputData
    {
        return new CreateTaskInputData(
            optional($this->user())->id,
            (int) $this->listId,
            $this->title,
            $this->detail
        );
    }
}
