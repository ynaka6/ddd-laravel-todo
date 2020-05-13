<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;
use Package\User\Application\InputData\LoginUserInputData;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable'],
        ];
    }

    public function inputData(): LoginUserInputData
    {
        return new LoginUserInputData($this->email, $this->password);
    }

    public function remember(): bool
    {
        return (bool) $this->filled('remember');
    }
}
