<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignDataRequest extends FormRequest
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
        return [
            'data' => 'required|array',
            'data.*.user_id' => 'required|string',
            'data.*.video_url' => 'required|url:http,https',
            'data.*.custom_fields' => 'nullable|json',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data.required' => 'The data field is required.',
            'data.array' => 'The data field must be an array.',
            'data.*.user_id.required' => 'The user ID is required for each data item.',
            'data.*.user_id.string' => 'The user ID must be a string.',
            'data.*.video_url.required' => 'The video URL is required for each data item.',
            'data.*.video_url.url' => 'The video URL must be a valid URL starting with http or https.',
            'data.*.custom_fields.json' => 'The custom fields must be a valid JSON string.',
        ];
    }
}
