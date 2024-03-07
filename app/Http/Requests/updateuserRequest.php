<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateuserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users_system,phone|max:10',
                'id_roles' => 'required',
                'status' => 'required|max:1',
                'id'=> 'required|exists:users',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa có tên tài khoản',
            'name.unique' => 'Tên tài khoản đã có trong database',
            'email.required' => 'chưa có email',
            'email.unique' => 'Tên email đã có trong database',
            'phone.required' => 'Vui lòng điền số điện thoại',
            'phone.max' => 'Vui lòng điền số có 10 chữ số',
            'phone.unique' => 'Số đã có trong database',
            'id_roles.required' => 'Vui lòng điền ID roles',
            'id.required'=> 'vui lòng điền id user',
            'id.exists'=> 'ID user không tồn tại',
            'status.required' => 'Vui lòng điền status id',
            'status.max' => 'Vui lòng điền 1 chữ số'
        ];
    }
}
