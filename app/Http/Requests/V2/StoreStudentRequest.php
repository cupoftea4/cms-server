<?php

namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Group;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class StoreStudentRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha', 'max:15'],
            'surname' => ['required', 'alpha', 'max:15'],
            'groupId' => ['required', 'numeric', 'min:1', 'max:' . Group::count()],
            'gender' => ['required', Rule::in(['M', 'F', 'B'])],
            'birthday' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'group_id' => $this->groupId,
        ]);
    }
}
