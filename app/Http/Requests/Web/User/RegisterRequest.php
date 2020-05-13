<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;
use Package\User\Application\InputData\RegisterUserInputData;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function inputData(): RegisterUserInputData
    {
        return new RegisterUserInputData($this->email, bcrypt($this->password));
    }
}
