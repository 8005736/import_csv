<?php

$config = new PhpCsFixer\Config();

return $config->setRules([
    'array_indentation'                         => true,
    'array_syntax'                              => ['syntax' => 'short'],
    'combine_consecutive_unsets'                => true,
    'single_quote'                              => false,
    'binary_operator_spaces'                    => [
        // 'align_double_arrow' => true,
        //  'align_equals'=> true,
        'operators' => ['=>' => 'align']
    ],
    'blank_line_before_statement'                  => true,
    'braces'                                       => [
        'allow_single_line_closure'                   => true,
        'position_after_functions_and_oop_constructs' => 'same',
    ],
    'cast_spaces'                      => true,
    'concat_space'                     => ['spacing' => 'one'],
    'declare_equal_normalize'          => true,
    'function_typehint_space'          => true,
    'fully_qualified_strict_types'     => true,
    // 'hash_to_slash_comment'            => true,
    'include'                          => true,
    'lowercase_cast'                   => true,
    /*
        'no_extra_consecutive_blank_lines' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ],
		*/

    'no_multiline_whitespace_around_double_arrow' => true,
    'no_spaces_around_offset'                     => true,
    'no_trailing_comma_in_list_call'              => true,
    'no_whitespace_before_comma_in_array'         => true,
    'no_whitespace_in_blank_line'                 => true,
    'normalize_index_brace'                       => true,
    'object_operator_without_whitespace'          => true,
    'ordered_imports'                             => [
        'sort_algorithm' => 'alpha',
        'imports_order'  => ["const", "class", "function"]
    ],
    'ordered_class_elements' => [
        "order" => [
            "use_trait",
            "constant_public",
            "constant_protected",
            "constant_private",
            "property_public",
            "property_protected",
            "property_private",
            "construct",
            "destruct",
            "magic",
            "phpunit",
            "method_private",
            "method_protected",
            "method_public"
        ],
    ],
    'single_import_per_statement'        => true,
    'single_blank_line_before_namespace' => true,
    'ternary_operator_spaces'            => true,
    'trim_array_spaces'                  => true,
    'unary_operator_spaces'              => true,
    'whitespace_after_comma_in_array'    => true,
])->setLineEnding("\n");

/*
$header = <<<'EOF'
This file is part of PHP CS Fixer.
(c) Fabien Potencier <fabien@symfony.com>
    Dariusz Rumiński <dariusz.ruminski@gmail.com>
This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude('tests/Fixtures')
    ->in(__DIR__)
    ->append([
        __DIR__.'/dev-tools/doc.php',
    ])
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP71Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
        'header_comment' => ['header' => $header],
    ])
    ->setFinder($finder)
;

return [];
*/
