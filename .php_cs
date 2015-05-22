<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;
use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;
use Symfony\CS\FixerInterface;

$header = <<<'EOF'
This file is part of the Holiday Library.

(c) Michał Mańko <github@michalmanko.com>

For the full copyright and license information, please view the LICENSE.md
file that was distributed with this source code.
EOF;
HeaderCommentFixer::setHeader($header);

$finder = DefaultFinder::create()
    ->in(array(
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ));

return Config::create()
    ->level(FixerInterface::NONE_LEVEL)
    ->fixers(array(
        'psr0',
        'encoding',
        'short_tag',
        'braces',
        'elseif',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiple_use',
        'parenthesis',
        'php_closing_tag',
        'single_line_after_imports',
        'trailing_spaces',
        'visibility',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_params',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unary_operators_spaces',
        'unused_use',
        'whitespacy_lines',
        'align_double_arrow',
        'align_equals',
        'concat_with_spaces',
        'header_comment',
        'multiline_spaces_before_semicolon',
        'no_blank_lines_before_namespace',
        'ordered_use',
        'phpdoc_order',
        'long_array_syntax',
        'header_comment',
    ))
    ->finder($finder);
