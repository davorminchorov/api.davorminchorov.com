<?php

namespace DavorMinchorov\Contact\Api\V1\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns'],
            'message' => ['required', 'string'],
        ];
    }
}
