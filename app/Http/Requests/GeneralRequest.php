<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(schema="GeneralRequest")
 * {
 *
 *   @OA\Property(
 *     property="quantity",
 *     type="int",
 *     description="The pagination quantity"
 *   ),
 *   @OA\Property(
 *     property="search",
 *     type="string",
 *     description="The search term"
 *   ),
 * }
 */
class GeneralRequest extends FormRequest
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
            'quantity' => 'nullable|numeric',
            'search' => 'nullable|string',
        ];
    }
}
