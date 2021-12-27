<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnounceRequest extends FormRequest
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
            "name"=>"required|max:20",
            "description"=>"required|min:10|max:50",
            "price"=>"required"
        ];
    }
    public function messages(){
        return[
            "name.required"=>"Devi inserire un titolo!",
            "description.required"=>"Devi inserire una descrizione!",
            "name.max"=>"Il titolo può essere al massimo di 20 caratteri",
            "description.min"=>"La descrizione deve essere minimo di 10 caratteri",
            "description.max"=>"La descrizione deve essere al massimo di 50 caratteri"
        ];
}
}
