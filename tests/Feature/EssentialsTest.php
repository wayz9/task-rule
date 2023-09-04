<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

test('can extract urls from payload', function() {
    $text = File::get(base_path('tests/Resources/payload.html'));

    $result = Str::of($text)
        ->matchAll('/<a[^>]+href="([^"]+)"/i');

    expect($result)
        ->toHaveCount(5);
});