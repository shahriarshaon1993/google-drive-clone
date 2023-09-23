<?php

namespace App\Http\Requests;

class ShareFilesRequest extends FilesActionsRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => 'required|email'
        ]);
    }
}
