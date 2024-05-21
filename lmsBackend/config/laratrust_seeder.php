<?php

return [
    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'books' => 'c,r,u,d',
            'authors' => 'c,r,u,d',
            'members' => 'c,r,u,d',
            'borrow_books' => 'c,r,u,d',
            
        ],
        'moderator' => [
            'books' => 'c,r,u',
            'authors' => 'c,r,u',
            'members' => 'c,r,u',
            'borrow_books' => 'c,r,u',
        ]
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],
];