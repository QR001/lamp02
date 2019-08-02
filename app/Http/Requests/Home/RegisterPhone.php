<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPhone extends FormRequest
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
            
            'name' => 'required|regex:/^[a-zA-Z]{1}[\w]{5,15}$/|unique:users',
            'pwd' => 'required|regex:/^[\w]{6,18}$/',
            'repwd' => 'required|same:pwd',
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
      
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
            'repwd.same'=>'两次密码不一致',
            'repwd.required'=>'确认密码字段是必填的',
            'phone.required'=>'手机号必填',    
            'phone.regex'=>'手机号格式错误', 
        ];
    }
}
