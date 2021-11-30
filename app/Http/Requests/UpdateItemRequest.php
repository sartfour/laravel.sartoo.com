<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'item_type_id' => 'item type',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name of this type has already been taken.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('items')->where(function ($query) {
                    return $query->where('item_type_id', $this->item_type_id);
                })->ignore($this->item)
            ],
            'item_type_id' => 'required'
        ];
    }
}
