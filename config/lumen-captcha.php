<?php

return [

    'characters' => '2346789abcdefghjmnpqrtuxyzABCDEFGHJMNPQRTUXYZ',

    'useful_time' => 5, //驗證碼有效時間（分鐘）

    'login'   => [ //驗證碼樣式
        'length'    => 4, //驗證碼字數
        'width'     => 100, //圖片寬度
        'height'    => 44, //字體大小和圖片高度
        'angle'     => 10, //字體傾斜度
        'lines'     => 2, //橫線數
        'quality'   => 90, //品質
        'invert'    =>false, //反相
        'bgImage'   =>true, //背景圖
        'bgColor'   =>'#ffffff',
        'fontColors'=>['#339900','#ff3300','#9966ff','#3333ff'],//字體顏色
    ],

    'flat'   => [
        'length'    => 6,
        'width'     => 160,
        'height'    => 46,
        'quality'   => 90,
        'lines'     => 6,
        'bgImage'   => false,
        'bgColor'   => '#ecf2f4',
        'fontColors'=> ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast'  => -5,
    ],

    'mini'   => [
        'length'    => 3,
        'width'     => 60,
        'height'    => 32,
    ],

    'inverse'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'sensitive' => true,
        'angle'     => 12,
        'sharpen'   => 10,
        'blur'      => 2,
        'invert'    => true,
        'contrast'  => -5,
    ]

];