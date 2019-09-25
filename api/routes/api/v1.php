<?php

Route::get('/', function () {
    $categories = App\Domains\Category\Models\Category::get();
    dd($categories);
});

Route::get('/ping', function () {
    return response()->json([
        'pong' => time()
    ]);
});

