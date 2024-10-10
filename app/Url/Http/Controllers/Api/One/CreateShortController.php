<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

namespace App\Url\Http\Controllers\Api\One;

use App\Url\Actions\Urls\CreateShort;
use App\Url\Exceptions\InvalidUrlException;
use App\Url\Http\Requests\CreateShortRequest;
use App\Url\ValueObjects\Url;

class CreateShortController
{
    public function __invoke(CreateShortRequest $request)
    {
        try {
            $realUrl = Url::fromString($request->validated('url'));
            $shortUrl = (new CreateShort($realUrl))();

        } catch (InvalidUrlException $exception) {
            return response()->json(['message' => $exception->getMessage(), ['errors' => ['url' => [$exception->getMessage()]]]], 422);
        } catch (\Throwable $exception) {
            return response()->json(['message' => 'Unexpected error occurred', 'errors' => [[$exception->getMessage()]]], 500);
        }

        return response()->json(['url' => sprintf('<%s>', $shortUrl->url)], options: JSON_UNESCAPED_SLASHES);
    }
}
