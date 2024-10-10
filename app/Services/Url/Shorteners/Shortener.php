<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Services\Url\Shorteners;

interface Shortener
{
    public function shorten(string $url): string;
}
