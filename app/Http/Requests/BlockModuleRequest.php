<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockModuleRequest extends FormRequest
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
         return [
            // 'block_code' => [
            //     'required',
            //     'string',
            //     'max:50',
            //     'unique:blocks,block_code,' . $this->block,
            // ],
            'block_name'  => 'required|string|max:50',
            'block_order' => 'nullable|integer|min:1',
            'is_active'   => 'required|in:0,1',
        ];
    }
}
