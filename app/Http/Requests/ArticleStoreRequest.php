<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
            'author' => 'string|max:255',
            'status_id' => 'required|integer|exists:status,id',
            'category_id' => 'integer|exists:categories,id',
            'user_id' => 'integer|exists:users,id',
        ];
        
        return $rules;
    }

    protected function prepareForValidation()
    {
        $data = [];

        $data['status_id'] = StatusEnum::DRAFT->value;
        $data['title'] = Str::title($this->title);
        $data['user_id'] = Auth::user()->id;
        if ($this->has('author') && $this->author !== null) {
            $data['author'] = $this->author;
        } else {
            $data['author'] = Auth::user()->name;
        }
        $this->merge($data);
    }
}
