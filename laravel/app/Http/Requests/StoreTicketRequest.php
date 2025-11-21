<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => ['required','string','regex:/^\+?[1-9]\d{1,14}$/'],
            'subject' => 'required|string|max:255',
            'text' => 'required|string',
            'files.*' => 'file|max:10240', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'email.required' => 'Эл почта обязательно для заполнения',
            'email.email' => 'Эл почта должно быть корректным адресом эл почты',
            'phone.required' => 'Телефон обязательно для заполнения',
            'phone.regex' => 'Телефон должно быть в формате +7XXXXXXXXX',
            'subject.required' => 'Тема обязательно для заполнения',
            'text.required' => 'Текст обязательно для заполнения',
            'text.string' => 'Текст должно быть строкой',
            'files.*.file' => 'Каждый файл должен быть корректным файлом',
            'files.*.max' => 'Размер файла не должен превышать 10 МБ',
        ];
    }
}
