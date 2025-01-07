<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name' => ['nullable', 'string', 'max:255'],
        'last_name' => ['nullable', 'string', 'max:255'],
        'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
        'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
        'type' => ['nullable', 'string', 'in:male,female,other'],
        'bio' => ['nullable', 'string'],
        'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        'country_id' => ['nullable', 'exists:countries,id']
    ];
}
}
