<?php

namespace Dnsoft\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:menu__menus,slug,'.$this->route('id'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('menu::message.name'),
            'slug' => __('menu::message.slug'),
        ];
    }
}
