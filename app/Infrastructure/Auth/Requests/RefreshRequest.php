<?php

namespace App\Infrastructure\Auth\Requests;

use App\Infrastructure\Http\ApiRequest;

class RefreshRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'refresh_token'    => 'required'
        ];
    }
}
