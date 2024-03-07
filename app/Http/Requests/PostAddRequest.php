<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|unique:products|max:255|min:5',
            'title' => 'required',
            'contents' => 'required',
            'image_path' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên không được phép trùng',
            'name.max' => 'Tên không được phép quá 255 ký tự',
            'name.min' => 'Tên không được phép nhỏ hơn 5 ký tự',
            'title.required' => 'Tóm tắt không được để trống',
            'image_path.required' => 'Hình ảnh không được để trống',
            'contents.required' => 'Nội dung sản phẩm không được để trống',

        ];
    }
}
