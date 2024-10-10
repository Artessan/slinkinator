<?php
/**
 * @author Johann Casanova <johann@artessandevs.co>
 * @copyright 2024
 *
 * @since  2024-10
 */

declare(strict_types=1);

use App\Url\Http\Controllers\Api\One\CreateShortController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/status', fn () => response()->json(['status' => 'ok']));
    Route::post('/short-urls', CreateShortController::class)->name('api.short-urls.create');
});
