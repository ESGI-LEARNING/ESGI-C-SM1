<?php

return [
    'host'     => getenv('DB_HOST') ?: 'localhost',
    'database' => getenv('DB_DATABASE') ?: null,
    'port'     => getenv('DB_HOST') ?: '3306',
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'prefix'   => getenv('DB_PREFIX'),
];
