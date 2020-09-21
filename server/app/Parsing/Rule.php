<?php

namespace App\Parsing;

use Closure;
use App\Parsing\DOM\Element;
use App\Parsing\DOM\Document;

class Rule
{
    /**
     * @var \Closure[]
     */
    protected $closures = [];

    /**
     * @var mixed
     */
    protected $default = null;

    /**
     * @param  \App\Parsing\DOM\Element[]  $elements
     * @param  int|null  $index
     * @return null|\App\Parsing\DOM\Element|\App\Parsing\DOM\Element[]
     */
    protected static function takeElement($elements, $index = null)
    {
        if (is_null($index)) {
            return $elements;
        }

        if ($index < 0) {
            $index += count($elements);
        }

        return isset($elements[$index]) ? $elements[$index] : null;
    }

    /**
     * @param  mixed  $source
     * @return mixed
     */
    public function evaluate($source)
    {
        return array_reduce($this->closures, function ($result, $closure) {
            return $closure($result);
        }, $source);
    }

    /**
     * @param  mixed  $source
     * @return bool
     */
    public function empty($source)
    {
        return empty($this->evaluate($source));
    }

    /**
     * @param  mixed  $value
     * @return self
     */
    public function default($value)
    {
        $rule = clone $this;
        $rule->default = $value;

        return $rule;
    }

    /**
     * @param  int  $levels
     * @return self
     */
    public function parent($levels = 1)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($levels) {
            for ($level = 1; $level <= $levels; $level++) {
                if ($result instanceof Element) {
                    $result = $result->parentElement();
                } else {
                    break;
                }
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function children()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return $result->childElements();
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  int  $index
     * @return self
     */
    public function child($index)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($index) {
            if ($result instanceof Element || $result instanceof Document) {
                return static::takeElement(
                    $result->childElements(), $index
                );
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function lastChild()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return $result->lastElementChild();
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function firstChild()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return $result->firstElementChild();
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function nextSibling()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return $result->nextElementSibling();
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function previousSibling()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return $result->previousElementSibling();
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function html()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                $html = $result->saveHTML($result);

                return $html === false ? '' : trim($html);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function text()
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) {
            if ($result instanceof Element || $result instanceof Document) {
                return trim($result->textContent);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $name
     * @param  mixed  $default
     * @return self
     */
    public function attribute($name, $default = null)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($name, $default) {
            if ($result instanceof Element) {
                $attribute = $result->getAttribute($name);

                if (empty($attribute)) {
                    if ($result->hasAttribute($name)) {
                        return true;
                    }

                    return $default;
                }

                return $attribute;
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $name
     * @param  mixed  $default
     * @return self
     */
    public function attr($name, $default = null)
    {
        return $this->attribute($name, $default);
    }

    /**
     * @param  bool  $assoc
     * @param  int  $depth
     * @param  int  $options
     * @return self
     */
    public function fromJson(
        $assoc = false,
        $depth = 512,
        $options = 0)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $assoc,
            $depth,
            $options)
        {
            return json_decode(
                $result,
                $assoc,
                $depth,
                $options
            );
        };

        return $rule;
    }

    /**
     * @param  int  $options
     * @param  int  $depth
     * @return self
     */
    public function toJson($options = 0, $depth = 512)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($options, $depth)
        {
            return json_encode(
                $result, $options, $depth
            );
        };

        return $rule;
    }

    /**
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return self
     */
    public function take($key, $default = null)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($key, $default) {
            return data_get(
                $result,
                $key,
                $default
            );
        };

        return $rule;
    }

    /**
     * @param  string  $delimiter
     * @return self
     */
    public function explode($delimiter)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use ($delimiter) {
            return explode($delimiter, $result);
        };

        return $rule;
    }

    /**
     * @param  string  $delimiter
     * @return self
     */
    public function implode($delimiter)
    {
        $rule = $this->map(function () {
            return (new Rule)->text();
        });

        $rule->closures[] = function ($result) use ($delimiter) {
            return implode($delimiter, $result);
        };

        return $rule;
    }

    /**
     * @param  callable  $callback
     * @return self
     */
    public function map(callable $callback)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($callback) {
            $result = (array) $result;

            foreach ($result as $key => $value) {
                $value = $callback($value, $key);

                if ($value instanceof Rule) {
                    $value = $value->evaluate($value);
                }

                $result[$key] = $value;
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  callable  $callback
     * @return self
     */
    public function filter(callable $callback)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($callback) {
            return array_filter((array) $result, $callback);
        };

        return $rule;
    }

    /**
     * @param  string  $pattern
     * @param  int  $group
     * @param  mixed  $default
     * @return self
     */
    public function match(
        $pattern,
        $group = 0,
        $default = null)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use (
            $pattern,
            $group,
            $default)
        {
            if (preg_match($pattern, $result, $matches)) {
                if (isset($matches[$group])) {
                    return $matches[$group];
                }
            }

            return $default;
        };

        return $rule;
    }

    /**
     * @param  string  $pattern
     * @param  int  $group
     * @param  mixed  $default
     * @return self
     */
    public function matchAll(
        $pattern,
        $group = 0,
        $default = [])
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use (
            $pattern,
            $group,
            $default)
        {
            if (preg_match_all($pattern, $result, $matches)) {
                if (isset($matches[$group])) {
                    return $matches[$group];
                }
            }

            return $default;
        };

        return $rule;
    }

    /**
     * @param  string|string[]  $search
     * @param  string|string[]  $replace
     * @param  bool  $ignoreCase
     * @return self
     */
    public function replace(
        $search,
        $replace,
        $ignoreCase = false)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use (
            $search,
            $replace,
            $ignoreCase)
        {
            $function = $ignoreCase ? 'str_ireplace' : 'str_replace';

            return $function(
                $search, $replace, $result
            );
        };

        return $rule;
    }

    /**
     * @param  string|string[]  $pattern
     * @param  string|string[]  $replacement
     * @return self
     */
    public function pregReplace($pattern, $replacement)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use ($pattern, $replacement) {
            return preg_replace(
                $pattern, $replacement, $result
            );
        };

        return $rule;
    }

    /**
     * @param  string|string[]  $regex
     * @param  callable  $callback
     * @return self
     */
    public function pregReplaceCallback($regex, callable $callback)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use ($regex, $callback) {
            return preg_replace_callback(
                $regex, $callback, $result
            );
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function takeInteger()
    {
        return $this->match('/(-?\d+)/', 1);
    }

    /**
     * @return self
     */
    public function takeFloat()
    {
        return $this->match('/(-?\d+[.,]\d+)/', 1);
    }

    /**
     * @return self
     */
    public function takeNumeric()
    {
        return $this->match('/(-?\d+(?:[.,]\d+)?)/', 1);
    }

    /**
     * @return self
     */
    public function takeDigits()
    {
        return $this->pregReplace('/\D/', '');
    }

    /**
     * @return self
     */
    public function removeDigits()
    {
        return $this->pregReplace('/\d/', '');
    }

    /**
     * @return self
     */
    public function removeSpaces()
    {
        return $this->pregReplace('/\s/', '');
    }

    /**
     * @return self
     */
    public function removeHTMLEntities()
    {
        return $this->pregReplace('/&(?:[a-zA-Z]|(?:#\d+));/', '');
    }

    /**
     * @return self
     */
    public function toTimestamp()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return strtotime($result);
        };

        return $rule;
    }

    /**
     * @param  string  $format
     * @return self
     */
    public function toDateTime($format = 'Y-m-d H:i:s')
    {
        $rule = $this->toTimestamp();

        $rule->closures[] = function ($result) use ($format) {
            return date($format, $result);
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function toBool()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return (bool) $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function toInt()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return (int) $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function toFloat()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return (float) $result;
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function toLowerCase()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return mb_strtolower($result);
        };

        return $rule;
    }

    /**
     * @return self
     */
    public function toUpperCase()
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) {
            return mb_strtoupper($result);
        };

        return $rule;
    }

    /**
     * @param  string  $value
     * @return self
     */
    public function append($value)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use ($value) {
            return $result.$value;
        };

        return $rule;
    }

    /**
     * @param  string  $value
     * @return self
     */
    public function prepend($value)
    {
        $rule = $this->text();

        $rule->closures[] = function ($result) use ($value) {
            return $value.$result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  int|null  $index
     * @return self
     */
    public function find($selector, $index = 0)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use ($selector, $index) {
            if ($result instanceof Element || $result instanceof Document) {
                return static::takeElement(
                    $result->querySelectorAll($selector), $index
                );
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @return self
     */
    public function findAll($selector)
    {
        return $this->find($selector, null);
    }

    /**
     * @param  string  $selector
     * @return self
     */
    public function findLast($selector)
    {
        return $this->find($selector, -1);
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  int|null  $index
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findWhereText(
        $selector,
        $value,
        $index = 0,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $selector,
            $value,
            $index,
            $ignoreCase,
            $trimSpaces)
        {
            if ($result instanceof Element || $result instanceof Document) {
                $elements = [];

                foreach ($result->querySelectorAll($selector) as $element) {
                    $text = $element->textContent;

                    if ($trimSpaces) {
                        $text = trim($text);
                    }

                    $function = $ignoreCase ? 'strcasecmp' : 'strcmp';

                    if ($function($text, $value) === 0) {
                        $elements[] = $element;
                    }
                }

                return static::takeElement($elements, $index);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findAllWhereText(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereText(
            $selector,
            $value,
            null,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findLastWhereText(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereText(
            $selector,
            $value,
            -1,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $pattern
     * @param  int|null  $index
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findWhereTextMatches(
        $selector,
        $pattern,
        $index = 0,
        $trimSpaces = true)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $selector,
            $pattern,
            $index,
            $trimSpaces)
        {
            if ($result instanceof Element || $result instanceof Document) {
                $elements = [];

                foreach ($result->querySelectorAll($selector) as $element) {
                    $text = $element->textContent;

                    if ($trimSpaces) {
                        $text = trim($text);
                    }

                    if (preg_match($pattern, $text)) {
                        $elements[] = $element;
                    }
                }

                return static::takeElement($elements, $index);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  string  $pattern
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findAllWhereTextMatches(
        $selector,
        $pattern,
        $trimSpaces = true)
    {
        return $this->findWhereTextMatches(
            $selector,
            $pattern,
            null,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $pattern
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findLastWhereTextMatches(
        $selector,
        $pattern,
        $trimSpaces = true)
    {
        return $this->findWhereTextMatches(
            $selector,
            $pattern,
            -1,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  int|null  $index
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findWhereTextContains(
        $selector,
        $value,
        $index = 0,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $selector,
            $value,
            $index,
            $ignoreCase,
            $trimSpaces)
        {
            if ($result instanceof Element || $result instanceof Document) {
                $elements = [];

                foreach ($result->querySelectorAll($selector) as $element) {
                    $text = $element->textContent;

                    if ($trimSpaces) {
                        $text = trim($text);
                    }

                    $function = $ignoreCase ? 'mb_stripos' : 'mb_strpos';

                    if ($function($text, $value) !== false) {
                        $elements[] = $element;
                    }
                }

                return static::takeElement($elements, $index);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findAllWhereTextContains(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextContains(
            $selector,
            $value,
            null,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findLastWhereTextContains(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextContains(
            $selector,
            $value,
            -1,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  int|null  $index
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findWhereTextEndsWith(
        $selector,
        $value,
        $index = 0,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $selector,
            $value,
            $index,
            $ignoreCase,
            $trimSpaces)
        {
            if ($result instanceof Element || $result instanceof Document) {
                $elements = [];

                foreach ($result->querySelectorAll($selector) as $element) {
                    $text = $element->textContent;

                    if ($trimSpaces) {
                        $text = trim($text);
                    }

                    $pos = mb_strlen($text) - mb_strlen($value);
                    $function = $ignoreCase ? 'mb_stripos' : 'mb_strpos';

                    if ($function($text, $value) === $pos) {
                        $elements[] = $element;
                    }
                }

                return static::takeElement($elements, $index);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findAllWhereTextEndsWith(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextEndsWith(
            $selector,
            $value,
            null,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findLastWhereTextEndsWith(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextEndsWith(
            $selector,
            $value,
            -1,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  int|null  $index
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findWhereTextStartsWith(
        $selector,
        $value,
        $index = 0,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        $rule = clone $this;

        $rule->closures[] = function ($result) use (
            $selector,
            $value,
            $index,
            $ignoreCase,
            $trimSpaces)
        {
            if ($result instanceof Element || $result instanceof Document) {
                $elements = [];

                foreach ($result->querySelectorAll($selector) as $element) {
                    $text = $element->textContent;

                    if ($trimSpaces) {
                        $text = trim($text);
                    }

                    $function = $ignoreCase ? 'mb_stripos' : 'mb_strpos';

                    if ($function($text, $value) === 0) {
                        $elements[] = $element;
                    }
                }

                return static::takeElement($elements, $index);
            }

            return $result;
        };

        return $rule;
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findAllWhereTextStartsWith(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextStartsWith(
            $selector,
            $value,
            null,
            $ignoreCase,
            $trimSpaces
        );
    }

    /**
     * @param  string  $selector
     * @param  string  $value
     * @param  bool  $ignoreCase
     * @param  bool  $trimSpaces
     * @return self
     */
    public function findLastWhereTextStartsWith(
        $selector,
        $value,
        $ignoreCase = false,
        $trimSpaces = true)
    {
        return $this->findWhereTextStartsWith(
            $selector,
            $value,
            -1,
            $ignoreCase,
            $trimSpaces
        );
    }
}
