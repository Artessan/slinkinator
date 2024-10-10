<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

use App\Url\Exceptions\InvalidUrlException;
use App\Url\ValueObjects\Url;

test('can create url from valid string', function () {
    expect($url = Url::fromString('https://www.google.com'))->not->toThrow(InvalidUrlException::class)
        ->and((string) $url)->toBeUrl();
});

test('cant create url from invalid string', function () {
    expect(fn() => Url::fromString('invalidurl'))->toThrow(InvalidUrlException::class);
});
