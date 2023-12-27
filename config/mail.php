<?php

return [
    'host' => getenv('MAIL_HOST') ?: 'localhost',
    'port' => getenv('MAIL_PORT') ?: '587',
    'username' => getenv('MAIL_USERNAME'),
    'password' => getenv('MAIL_PASSWORD'),
    'from-address' => getenv('MAIL_FROM_NAME'),
    'from-name' => getenv('MAIL_FROM_NAME'),
];
