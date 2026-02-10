<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoadModuleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $moduleId = $this->route('module'); 
        // works for both create (null) and update

        return [
            'road_order' => 'required|string|max:20',
            'road_name' => 'required|string|max:200',
            'is_active' => 'required|string|max:30',
        ];
    }
}
