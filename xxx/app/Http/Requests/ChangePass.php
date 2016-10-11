<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePass extends Request
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
            'password' => 'required',
            'password_confirmation' => 'required'
        ];
    }

    public function message()
    {
        return [
            'password.required' => 'Mật khẩu có tối thiểu 6 ký tự',
            'password_confirmation.required' => 'Xát nhận lại mật khẩu chưa đúng'
        ];
    }

}
