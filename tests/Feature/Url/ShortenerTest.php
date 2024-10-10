<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

use function Pest\Laravel\postJson;

test('can create a short', function () {
    $response = postJson(route('api.short-urls.create'), ['url' => 'https://google.com']);
    $url = $response->json('url');

    $response->assertOk()->assertJsonStructure(['url']);

    expect($url)->toBeString()->and(trim($url, '<>'))->toBeUrl();
});

test('cant create a short with invalid url', function () {
    postJson(route('api.short-urls.create'), ['url' => 'google.com/invalid'])
        ->assertStatus(422)
        ->assertJsonStructure(['message']);
});
