<?php

return [
    'name' => getenv('APP_NAME') ?: 'Photography',
    'url'  => getenv('APP_URL') ?: 'http://localhost:8080',
    'env'  => getenv('APP_ENV') ?: 'dev',
    'install' => getenv('APP_INSTALL') ?: 'false',
];
