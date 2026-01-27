<?php

test('application is healthy', function () {
    expect(true)->toBeTrue();
});


test('sum of two numbers works correctly', function () {
    $a = 5;
    $b = 10;
    $sum = $a + $b;

    expect($sum)->toBe(5);
}); 