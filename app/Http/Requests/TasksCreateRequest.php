<?php

namespace App\Http\Requests;

class TasksCreateRequest extends Request
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
            'type'          => 'required',
            'name'          => 'required',
            'url'           => 'required|url',
            'budget'        => 'required',
            'price'         => 'required',
            'description'   => 'required',
            'images'        => 'required|mimes:jpg,jpeg',
        ];
    }
}
