<?php

return [
    'users' => [
        [
            'id' => '00000000-0000-0000-0000-000000000001',
            'name' => 'Corentin',
            'last_name' => 'LCM',
            'email' => 'corentin@leclosmesnil.fr',
            'active' => true,
            'admin' => true,
            'phone' => '+33601010101'
        ],
        [
            'id' => '00000000-0000-0000-0000-000000000002',
            'name' => 'Quentin',
            'last_name' => 'LCM',
            'email' => 'quentin@leclosmesnil.fr',
            'active' => true,
            'admin' => true,
            'phone' => '+33601010102'
        ]
    ],
    'post_categories' => [
        [
            'id' => '00000000-0000-0000-0001-000000000000',
            'name' => 'Informations Générales',
            'slug' => 'informations-generales',
        ],
        [
            'id' => '00000000-0000-0000-0002-000000000000',
            'name' => 'News du quartier',
            'slug' => 'news-du-quartier'
        ],
        [
            'id' => '00000000-0000-0000-0003-000000000000',
            'name' => 'Autre contenu',
            'slug' => 'autre-contenu'
        ]
    ],
    'posts' => [
        'authors' => [
            '00000000-0000-0000-0000-000000000001',
            '00000000-0000-0000-0000-000000000002'
        ],
        'categories' => [
            '00000000-0000-0000-0001-000000000000',
            '00000000-0000-0000-0002-000000000000'
        ],
        'posts_per_category' => [15, 25],
        'comments_per_post' => [1, 5]
    ]
];
