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
        'echo_tag_syntax' => ['format' => 'short', 'shorten_simple_statements_only' => false],
    ])
    ->setFinder($finder);