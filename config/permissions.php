<?php

return [


    'roles' => [
        'admin' => 'admin',
        'operator' => 'operator'
    ],

    'permissions' => [
        'admin' => '*',
        'writer' => [
            'post-content',
        ],
    ],

    'revert_permissions' => [
        'writer' => [
            'delete_own_content',
        ]
    ]
];
