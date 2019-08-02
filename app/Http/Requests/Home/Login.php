<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            //
            'name' => 'required',
            'pwd' => 'required|regex:/^[\w]{6,18}$/',
           
        ];
    }
     // 自定义错误删输出
     public function messages()
     {
         return [
             'name.required'=>'用户名是必填的',
             'name.regex'=>'用户名格式是以字母开头6-16位',
             'pwd.required'=>'密码是必填的',
             'pwd.regex'=>'密码格式是字母或数字6-18位',
             
         ];
     }
}
