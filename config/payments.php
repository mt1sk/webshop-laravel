<?php

return [
    'simple'    => [
        'name'      => 'Simple payment',
        /* additional fields example */
        /*'settings' => [
            [
                'name'  => 'Public key',
                'field' => 'simple_public_key',
            ],
            [
                'name'  => 'Mode',
                'field' => 'simple_mode',
                'options'=> [
                    'real'  => 'Real payment',
                    'test'  => 'Testing',
                ],
            ],
        ],*/
    ],
    'receipt'   => [
        'name'      => 'Bank receipt',
        'settings' => [
            [
                'name'  => 'Recipient',
                'field' => 'recipient',
            ],
            [
                'name'  => 'Recipient INN',
                'field' => 'inn',
            ],
            [
                'name'  => 'Recipient account',
                'field' => 'account',
            ],
            [
                'name'  => 'Recipient bank',
                'field' => 'bank',
            ],
            [
                'name'  => 'BIK',
                'field' => 'bik',
            ],
            [
                'name'  => 'Correspondent account',
                'field' => 'correspondent_account',
            ],
            [
                'name'  => 'Currency',
                'field' => 'banknote',
            ],
            [
                'name'  => 'Coins',
                'field' => 'pence',
            ],
        ],
    ],
];
