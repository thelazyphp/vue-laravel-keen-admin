<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UploadImage extends FormRequest
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
            'file' => 'required|file|max:51200|image',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        switch (App::getLocale()) {
            case 'ru':
                return [
                    'file.required' => 'Параметр [file] не указан.',
                    'file.file'     => 'Ошибка загрузки файла.',
                    'file.max'      => 'Размер файла не может превышать :max килобайт.',
                    'file.image'    => 'Допустимые типы файлов: jpeg, png, bmp, gif, svg, или webp.',
                ];
            default:
                return [];
        }
    }
}
