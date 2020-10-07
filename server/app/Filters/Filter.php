<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * @var string[]
     */
    protected $ignore = [
        'page',
        'per_page',
    ];

    /**
     * @var array
     */
    protected $defaults = [
        //
    ];

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort($value)
    {
        $order = 'asc';

        if (strpos($value, '-') === 0) {
            $order = 'desc';
            $value = substr($value, 1);
        }

        return $this->builder->orderBy($value, $order);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $params)
    {
        $this->builder = $builder;

        $params = array_merge(
            $this->defaults, $params
        );

        foreach ($params as $key => $value) {
            if (in_array($key, $this->ignore)) {
                continue;
            }

            $method = Str::camel($key);
            $simple = true;

            if (strpos($value, ':') !== false) {
                $simple = false;

                $method .= Str::camel(
                    explode(':', $value, 1)[0]
                );
            }

            if (method_exists($this, $method)) {
                $this->builder = call_user_func([$this, $method], $value);
            } else {
                if ($simple) {
                    $this->builder = $this->builder->where($key, $value);
                } else {
                    [$op, $value] = explode(':', $value, 2);

                    switch ($op) {
                        case 'like':
                            $this->builder = $this->builder->where($key, 'like', '%'.$value.'%');
                            break;
                        case 'not':
                            $this->builder = $this->builder->where($key, '<>', $value);
                            break;
                        case 'eq':
                            $this->builder = $this->builder->where($key, $value);
                            break;
                        case 'lt':
                            $this->builder = $this->builder->where($key, '<', $value);
                            break;
                        case 'le':
                            $this->builder = $this->builder->where($key, '<=', $value);
                            break;
                        case 'gt':
                            $this->builder = $this->builder->where($key, '>', $value);
                            break;
                        case 'ge':
                            $this->builder = $this->builder->where($key, '>=', $value);
                            break;
                        case 'in':
                            $this->builder = $this->builder->whereIn($key, explode(',', $value));
                            break;
                        case 'not_in':
                            $this->builder = $this->builder->whereNotIn($key, explode(',', $value));
                            break;
                    }
                }
            }
        }

        return $builder;
    }
}
