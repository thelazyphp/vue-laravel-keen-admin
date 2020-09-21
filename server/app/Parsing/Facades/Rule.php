<?php

namespace App\Parsing\Facades;

/**
 * @method static mixed evaluate(mixed $source)
 * @method static bool empty(mixed $source)
 * @method static \App\Parsing\Rule default(mixed $value)
 * @method static \App\Parsing\Rule parent(int $levels)
 * @method static \App\Parsing\Rule children()
 * @method static \App\Parsing\Rule child(int $index)
 * @method static \App\Parsing\Rule lastChild()
 * @method static \App\Parsing\Rule firstChild()
 * @method static \App\Parsing\Rule nextSibling()
 * @method static \App\Parsing\Rule previousSibling()
 * @method static \App\Parsing\Rule html()
 * @method static \App\Parsing\Rule text()
 * @method static \App\Parsing\Rule attribute(string $name, mixed $default)
 * @method static \App\Parsing\Rule attr(string $name, mixed $default)
 * @method static \App\Parsing\Rule fromJson(bool $assoc, int $depth, int $options)
 * @method static \App\Parsing\Rule toJson(int $options, int $depth)
 * @method static \App\Parsing\Rule take(string|array|int|null $key, mixed $default)
 * @method static \App\Parsing\Rule explode(string $delimiter)
 * @method static \App\Parsing\Rule implode(string $delimiter)
 * @method static \App\Parsing\Rule map(callable $callback)
 * @method static \App\Parsing\Rule filter(callable $callback)
 * @method static \App\Parsing\Rule match(string $pattern, int $group, mixed $default)
 * @method static \App\Parsing\Rule matchAll(string $pattern, int $group, mixed $default)
 * @method static \App\Parsing\Rule replace(string|string[] $search, string|string[] $replace, bool $ignoreCase)
 * @method static \App\Parsing\Rule pregReplace(string|string[] $pattern, string|string[] $replacement)
 * @method static \App\Parsing\Rule pregReplaceCallback(string|string[] $regex, callable $callback)
 * @method static \App\Parsing\Rule takeInteger()
 * @method static \App\Parsing\Rule takeFloat()
 * @method static \App\Parsing\Rule takeNumeric()
 * @method static \App\Parsing\Rule takeDigits()
 * @method static \App\Parsing\Rule removeDigits()
 * @method static \App\Parsing\Rule removeSpaces()
 * @method static \App\Parsing\Rule removeHTMLEntities()
 * @method static \App\Parsing\Rule toTimestamp()
 * @method static \App\Parsing\Rule toDateTime(string $format)
 * @method static \App\Parsing\Rule toBool()
 * @method static \App\Parsing\Rule toInt()
 * @method static \App\Parsing\Rule toFloat()
 * @method static \App\Parsing\Rule toLowerCase()
 * @method static \App\Parsing\Rule toUpperCase()
 * @method static \App\Parsing\Rule append(string $value)
 * @method static \App\Parsing\Rule prepend(string $value)
 * @method static \App\Parsing\Rule find(string $selector, int|null $index)
 * @method static \App\Parsing\Rule findAll(string $selector)
 * @method static \App\Parsing\Rule findLast(string $selector)
 * @method static \App\Parsing\Rule findWhereText(string $selector, string $value, int|null $index, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findAllWhereText(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findLastWhereText(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findWhereTextMatches(string $selector, string $pattern, int|null $index, bool $trimSpaces)
 * @method static \App\Parsing\Rule findAllWhereTextMatches(string $selector, string $pattern, bool $trimSpaces)
 * @method static \App\Parsing\Rule findLastWhereTextMatches(string $selector, string $pattern, bool $trimSpaces)
 * @method static \App\Parsing\Rule findWhereTextContains(string $selector, string $value, int|null $index, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findAllWhereTextContains(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findLastWhereTextContains(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findWhereTextEndsWith(string $selector, string $value, int|null $index, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findAllWhereTextEndsWith(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findLastWhereTextEndsWith(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findWhereTextStartsWith(string $selector, string $value, int|null $index, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findAllWhereTextStartsWith(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 * @method static \App\Parsing\Rule findLastWhereTextStartsWith(string $selector, string $value, bool $ignoreCase, bool $trimSpaces)
 */
class Rule
{
    /**
     * @var string
     */
    protected static $accessor = 'App\Parsing\Rule';

    /**
     * @param  string  $name
     * @param  array  $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static::$accessor)->{$name}(...$arguments);
    }
}
