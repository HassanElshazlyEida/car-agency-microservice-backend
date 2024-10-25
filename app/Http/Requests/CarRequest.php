<?php

namespace App\Http\Requests;

use App\Enums\CarAvailabilityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $isRequired = $this->isMethod('post') ? 'required':'sometimes';
        return [
            'name' => "$isRequired|string|max:255",
            'model' => "$isRequired|string|max:255",
            'price' => "$isRequired|numeric|min:0",
            'availability' => [$isRequired,new EnumRule(CarAvailabilityEnum::class)],
            'user_id' => 'required', 
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge(['user_id' => request()?->user()?->id]);
    }

}