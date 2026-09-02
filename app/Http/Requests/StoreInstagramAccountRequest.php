<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstagramAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_label' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:instagram_accounts,username',
            'access_token' => 'required|string',
            'status' => 'sometimes|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'account_label.required' => 'Account label is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username already exists.',
            'access_token.required' => 'Access token is required.',
        ];
    }
}