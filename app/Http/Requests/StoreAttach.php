<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttach extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:5,256',
            'data' => 'required|max:20480000',
        ];
    }
    
    /**
     * 准备验证数据
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'data' => base64_decode(substr($this->data, strpos($this->data, 'base64,') + 7))
        ]);
    }
}
