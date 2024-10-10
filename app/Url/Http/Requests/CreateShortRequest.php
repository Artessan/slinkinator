<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Url\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShortRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'url']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
