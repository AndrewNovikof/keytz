<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BooksRequest
 * @package App\Http\Requests
 *
 * @property string $includes
 * @property string $search
 * @property string $excluded_catalog
 */
class BooksRequest extends FormRequest
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
            'includes' => 'nullable',
            'search' => 'nullable',
            'excluded_catalog' => 'nullable|integer|exists:catalogs,id'
        ];
    }
}
