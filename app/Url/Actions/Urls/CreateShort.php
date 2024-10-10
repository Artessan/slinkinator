<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Url\Actions\Urls;

use App\Services\Url\Shorteners\Shortener;
use App\Url\Exceptions\InvalidUrlException;
use App\Url\ValueObjects\Url;
use Illuminate\Contracts\Container\BindingResolutionException;

readonly class CreateShort
{
    public function __construct(public Url $url)
    {

    }

    /**
     * @throws InvalidUrlException
     * @throws BindingResolutionException
     */
    public function __invoke(): Url
    {
        $shortener = app()->make(Shortener::class);

        return Url::fromString($shortener->shorten((string) $this->url));
    }
}
