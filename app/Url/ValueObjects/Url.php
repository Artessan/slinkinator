<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Url\ValueObjects;

use App\Url\Exceptions\InvalidUrlException;
use Stringable;

readonly class Url implements Stringable
{
    private function __construct(public string $url)
    {

    }

    public static function fromString(string $url): self
    {
        if (!self::isValid($url)) {
            throw new InvalidUrlException('Invalid URL');
        }

        return new self($url);
    }

    public static function isValid(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public function __toString()
    {
        return $this->url;
    }
}
