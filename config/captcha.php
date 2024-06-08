<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'],
    'default' => [
        'characters' => '2346789abcdefghjmnpqrtuxyzABCDEFGHJMNPQRTUXYZ', // Avoid confusing characters like 0, 1, l, I, O
        'length' => 4, // Reduce the number of characters
        'width' => 120, // Increase the width if needed
        'height' => 36, // Increase the height if needed
        'quality' => 90, // Set the image quality
        'math' => false, // Disable math captcha
        'expire' => 60, // Expiry time in seconds
        'bgImage' => false, // Disable background image
        'bgColor' => '#ffffff', // Background color
        'fontColors' => ['#000000'], // Simplify font color
        'contrast' => -5, // Reduce contrast for simplicity
        'fontSize' => 24, // Increase font size
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => true,
    ],

    'flat' => [
        'length' => 6,
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'lines' => 6,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast' => -5,
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ]
];
