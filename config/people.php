<?php

return [
    'Nic'  => [
        'blocked' => [
            'Dancer',
        ],
        'phone'   => '+64 27 123 4567',
        'email'   => 'Nic@santas.workshop'
    ],
    'Dancer'    => [
        'blocked' => [
            'Nic',
        ],
        'phone'   => '+64 27 123 4567',
        'email'   => 'Dancer@santas.workshop'
    ],
    'Prancer'    => [
        'blocked' => [
            'Dancer',
            'Nic',
        ],
        'phone'   => '+64 27 123 4567',
        'email'   => 'Prancer@santas.workshop'
    ],
    'Vixen'   => [
        'blocked' => [
            'Dancer',
            'Prancer',
            'Cupid'
        ],
        'phone'   => '+64 27 123 4567',
        'email'   => 'Vixen@santas.workshop'
    ],
    'Comet'     => [
        'blocked' => [
            'Cupid'
        ],
        'phone'   => '+64 27 123 4567',
        'email'   => 'Comet@santas.workshop'
    ],
    'Cupid' => [
        'blocked' => [
            'Comet',
        ],
        'phone' => '+64 27 123 4567',
        'email'   => 'Cupid@santas.workshop'
    ],

];