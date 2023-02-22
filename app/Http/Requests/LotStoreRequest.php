<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Image;

class LotStoreRequest extends FormRequest
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
            'name'          => 'required|string|min:3|max:255',
            'description'   => 'required|string|min:10|max:500',
            'category_id'   => 'required|numeric',
            'img'           => 'required|file|image',
            'price'         => 'required|numeric|min:10|max:9000',
            'step'          => 'required|numeric|min:10|max:200',
            'dt_end'        => 'required|date',
        ];
    }   

    public function validated()
    {
        $val = parent::validated();

        return array_merge($val, [
            'user_id' => auth('web')->user()->id,
            'img' => $val['img']->store('lots')
        ]);
    }
}