<?php

return [
    'Noel'    => [
        'blocked' => [
            'Dancer',
        ],
    ],
    'Dancer'  => [
        'blocked' => [
            'Noel',
        ],
    ],
    'Prancer' => [
        'blocked' => [
            'Dancer',
            'Noel',
        ],
    ],
    'Vixen'   => [
        'blocked' => [
            'Dancer',
            'Prancer',
            'Cupid',
        ],
    ],
    'Comet'   => [
        'blocked' => [
        ],
    ],
    'Cupid'   => [
        'blocked' => [
            'Comet',
        ],
    ],

];