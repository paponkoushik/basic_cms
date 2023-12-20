<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}
