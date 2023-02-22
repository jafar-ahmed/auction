<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidStoreRequest extends FormRequest
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
        $min = $this->route('lot')->getBidPrice();

        return [
            'price' => "required|numeric|min:$min|max:10000"
        ];
    }

    public function validated()
    {
        $v = parent::validated();
        $v['user_id'] = $this->user()->id;
        $v['lot_id']  = $this->route('lot')->id;
        
        return $v;
    }
}
