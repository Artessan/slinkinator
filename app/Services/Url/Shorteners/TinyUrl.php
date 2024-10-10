<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Services\Url\Shorteners;

use App\Url\ValueObjects\Url;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class TinyUrl implements Shortener
{
    public const string ENDPOINT = 'https://tinyurl.com/api-create.php';

    /**
     * @throws RequestException
     */
    public function shorten(string $url): string
    {
        return Http::get(self::ENDPOINT, ['url' => $url])
            ->throw()
            ->body();
    }
}
