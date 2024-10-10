<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

use function Pest\Laravel\postJson;

test('invalid token can access shortener', function (?string $token) {
    $headers = ['Authorization' => 'Bearer ' . $token];
    postJson(route('api.short-urls.create'), ['url' => 'https://google.com'], $headers)
        ->assertStatus(401);
})->with(['invalid-token', '{}[', '(){([})}']);

test('can create a short', function (string $token) {
    $headers = ['Authorization' => 'Bearer ' . $token];
    $response = postJson(route('api.short-urls.create'), ['url' => 'https://google.com'], $headers);
    $url = $response->json('url');

    $response->assertOk()->assertJsonStructure(['url']);

    expect($url)->toBeString()->and(trim($url, '<>'))->toBeUrl();
})->with([''. '()', '(())', '{}()[]', '[(){[()]}]([{}]())']);

test('cant create a short with invalid url', function (string $token) {
    $headers = ['Authorization' => 'Bearer ' . $token];
    postJson(route('api.short-urls.create'), ['url' => 'google.com/invalid'], $headers)
        ->assertStatus(422)
        ->assertJsonStructure(['message']);
})->with(['()']);
