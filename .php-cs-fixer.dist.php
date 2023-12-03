<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('storage-db');

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'binary_operator_spaces' => [
            'default' => 'align',
        ],
        'array_syntax' => ['syntax' => 'short'],
        'yoda_style' => false,
    ])
    ->setFinder($finder);