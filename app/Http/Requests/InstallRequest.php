<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest
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
        ];
    }

    public function getHmac()
    {
        return $this->hmac;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getShopDomain()
    {
        return $this->shop;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getCode()
    {
        return $this->code;
    }
}
