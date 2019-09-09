<?php

return [
    'simple'    => [
        'name'      => 'Simple delivery',
        /* additional fields example */
        /*'settings' => [
            [
                'name'  => 'API key',
                'field' => 'api_key',
            ],
            [
                'name'  => 'Mode',
                'field' => 'mode',
                'options'=> [
                    'real'  => 'Real',
                    'test'  => 'Testing',
                ],
            ],
        ],*/
    ],
    'novaposhta'    => [
        'name'      => 'Novaposhta delivery',
        'settings' => [
            [
                'name'  => 'API key',
                'field' => 'api_key',
            ],
            [
                'name'  => 'Default weight',
                'field' => 'weight',
            ],
            [
                'name'  => 'Service type',
                'field' => 'service_type',
                'options'=> [
                    'DoorsDoors'        => 'Doors doors',
                    'DoorsWarehouse'    => 'Doors warehouse',
                    'WarehouseWarehouse'=> 'Warehouse warehouse',
                    'WarehouseDoors'    => 'Warehouse doors',
                ],
            ],
            [
                'name'  => 'Cargo type',
                'field' => 'cargo_type',
                'options'=> [
                    'Cargo'         => 'Cargo',
                    'Documents'     => 'Documents',
                    'TiresWheels'   => 'Tires wheels',
                    'Pallet'        => 'Pallet',
                ],
            ],
            [
                'name'  => 'City sender',
                'field' => 'city_sender',
                'options'=> [
                ],
            ],
        ],
    ],
];
