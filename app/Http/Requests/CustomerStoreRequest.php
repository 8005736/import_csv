<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest {
    public function authorize() {
        return false;
    }

    public function rules() {
        return [
            "email" => "email:rfc,dns",
            "age"   => "min:18|max:20|integer",
        ];
    }

    public function messages() {
        return [
            "email" => "Некорректный email",
            "age"   => "Некорректный возраст",
        ];
    }
}
