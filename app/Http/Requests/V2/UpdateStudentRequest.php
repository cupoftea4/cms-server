<?php

namespace App\Http\Requests\V2;

    use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'groupId' => ['required', 'numeric', 'min:1', 'max:'. Group::count()],
                'gender' => ['required', Rule::in(['M', 'F', 'B'])],
                'birthday' => ['nullable', 'date']
            ];
        } 
        // must be PATCH
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'surname' => ['sometimes', 'required', 'string', 'max:255'],
            'groupId' => ['sometimes', 'required', 'numeric', 'min:1', 'max:' . Group::count()],
            'gender' => ['sometimes', 'required', Rule::in(['M', 'F', 'B'])],
            'birthday' => ['sometimes', 'nullable', 'date']
        ];

    }

    protected function prepareForValidation(): void
    {
        if ($this->groupId) {
            $this->merge([
                'group_id' => $this->groupId,
            ]);
        }
    }
}
