<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\StatusEnum;
use Illuminate\Support\Str;

class ArticleStoreRequest extends FormRequest
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

        $rules = [
            'title' => 'required|string|max:255|unique:articles',
            'body' => 'required|string',
            'status_id' => 'required|integer|exists:status,id',
            'category_id' => 'integer|exists:categories,id',
        ];
        
        return $rules;
    }

    protected function prepareForValidation()
    {
        $data = [];

        $data['status_id'] = StatusEnum::DRAFT->value;
        $data['title'] = Str::title($this->title);

        $this->merge($data);
    }
}
